<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\PointTransaction;
use App\Models\Trip;
use App\Services\Payments\PaymentFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function create(Request $request, Trip $trip)
    {
        $request->validate([
            'number_of_seats' => 'required|integer|min:1|max:' . $trip->available_seats,
        ]);

        $seats = (int) $request->number_of_seats;
        $totalPrice = $trip->seat_price * $seats;

        return view('payment.create', compact('trip', 'seats', 'totalPrice'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'number_of_seats' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'phone' => 'nullable|string',
            'pin' => 'nullable|string',
            'card_number' => 'nullable|string',
            'expiry' => 'nullable|string',
            'cvv' => 'nullable|string',
            'cardholder_name' => 'nullable|string',
            'ticket_email' => 'required|email:rfc,dns',
        ]);

        $trip = Trip::findOrFail($request->trip_id);

        if ($trip->available_seats < $request->number_of_seats) {
            return back()->with('error', 'Not enough available seats.');
        }

        $service = PaymentFactory::make($request->payment_method);

        $validationErrors = $service->validate($request->all());
        if (!empty($validationErrors)) {
            return back()->withErrors($validationErrors)->withInput();
        }

        $totalPrice = $trip->seat_price * $request->number_of_seats;
        $discountAmount = $trip->getDiscountAmount() * $request->number_of_seats;
        $finalPrice = $totalPrice - $discountAmount;

        // 1. Process payment first — no DB writes yet
        try {
            $tempBooking = new Booking();
            $tempBooking->total_price = $finalPrice;

            $result = $service->process($tempBooking, $request->all());
        } catch (\Exception $e) {
            // Unexpected error — save as failed to protect user's data
            $failedBooking = DB::transaction(function () use ($trip, $request, $finalPrice) {
                return Booking::create([
                    'user_id' => Auth::id(),
                    'trip_id' => $trip->id,
                    'number_of_seats' => $request->number_of_seats,
                    'total_price' => $finalPrice,
                    'payment_status' => 'failed',
                    'payment_method' => $request->payment_method,
                ]);
            });

            Log::error('Payment processing error: ' . $e->getMessage(), [
                'booking_id' => $failedBooking->id,
                'error' => $e,
            ]);

            return back()->with('error', __('Payment processing error: ') . $e->getMessage());
        }

        if (!$result['success']) {
            return back()->with('error', __('Payment failed. Please try again.'));
        }

        // 2. Payment succeeded — save booking, payment, points
        try {
            $finalResult = DB::transaction(function () use ($trip, $request, $finalPrice, $result) {
                $booking = Booking::create([
                    'user_id' => Auth::id(),
                    'trip_id' => $trip->id,
                    'number_of_seats' => $request->number_of_seats,
                    'total_price' => $finalPrice,
                    'payment_status' => 'paid',
                    'payment_method' => $request->payment_method,
                ]);

                $trip->decrement('available_seats', $request->number_of_seats);
                if ($trip->fresh()->available_seats <= 0) {
                    $trip->update(['status' => 'closed']);
                }

                $paymentData = $request->only(['phone', 'card_number', 'expiry', 'cardholder_name']);
                $paymentData['masked_card'] = $request->card_number
                    ? '****' . substr(preg_replace('/\s/', '', $request->card_number), -4)
                    : null;
                $paymentData['ticket_email'] = $request->ticket_email;

                $payment = Payment::create([
                    'booking_id' => $booking->id,
                    'user_id' => Auth::id(),
                    'amount' => $finalPrice,
                    'payment_method' => $request->payment_method,
                    'status' => 'completed',
                    'transaction_id' => $result['transaction_id'],
                    'paid_at' => now(),
                    'payment_data' => $paymentData,
                ]);

                $user = Auth::user();
                $user->increment('points', $booking->number_of_seats);
                PointTransaction::create([
                    'user_id' => $user->id,
                    'points' => $booking->number_of_seats,
                    'type' => 'earned',
                    'booking_id' => $booking->id,
                    'expires_at' => now()->addMonths(3),
                ]);

                return compact('booking', 'payment');
            });

            try {
                BookingCreated::dispatch($finalResult['booking'], $finalResult['payment'], $request->ticket_email);
            } catch (\Exception $e) {
                Log::error('Failed to send booking email: ' . $e->getMessage(), [
                    'booking_id' => $finalResult['booking']->id,
                    'error' => $e,
                ]);
            }

            return redirect()->route('bookings.index')
                ->with('success', __('Payment successful! Booking confirmed.'));
        } catch (\Exception $e) {
            Log::error('Failed to save booking after successful payment: ' . $e->getMessage(), ['error' => $e]);
            return back()->with('error', __('Payment successful but booking could not be saved. Please contact support.'));
        }
    }

    public function callback(Request $request)
    {
        $method = $request->input('payment_method');
        $service = PaymentFactory::make($method);
        $result = $service->callback($request->all());

        if ($result['success'] && ($request->input('status') === 'completed' || $request->input('status') === 'paid')) {
            $payment = Payment::where('transaction_id', $result['transaction_id'])->first();
            if ($payment && !$payment->paid_at) {
                $payment->update(['status' => 'completed', 'paid_at' => now()]);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
