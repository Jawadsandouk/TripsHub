<?php

namespace App\Http\Controllers;

use App\Mail\BookingTicketMail;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\PointTransaction;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['trip', 'trip.user', 'payment'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request, Trip $trip)
    {
        $request->validate([
            'number_of_seats' => 'required|integer|min:1',
        ]);

        if (in_array($trip->status, ['closed', 'canceled', 'finished', 'paused'])) {
            return back()->with('error', 'This trip is not available for booking.');
        }

        if ($trip->available_seats < $request->number_of_seats) {
            return back()->with('error', 'Not enough available seats.');
        }

        $totalPrice = $trip->seat_price * $request->number_of_seats;
        $discountAmount = $trip->getDiscountAmount() * $request->number_of_seats;
        $finalPrice = $totalPrice - $discountAmount;

        Booking::create([
            'user_id' => Auth::id(),
            'trip_id' => $trip->id,
            'number_of_seats' => $request->number_of_seats,
            'total_price' => $finalPrice,
        ]);

        $trip->decrement('available_seats', $request->number_of_seats);

        if ($trip->fresh()->available_seats <= 0) {
            $trip->update(['status' => 'closed']);
        }

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function tripBookings(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $bookings = Booking::with('user')
            ->where('trip_id', $trip->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('office.bookings', compact('trip', 'bookings'));
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $trip = $booking->trip;
        $trip->increment('available_seats', $booking->number_of_seats);

        if ($trip->fresh()->available_seats > 0 && $trip->status === 'closed') {
            $trip->update(['status' => 'open']);
        }

        // Deduct points earned from this booking
        $earnedTransactions = PointTransaction::where('booking_id', $booking->id)
            ->where('type', 'earned')
            ->get();

        foreach ($earnedTransactions as $txn) {
            $user = Auth::user();
            $user->decrement('points', $txn->points);
            PointTransaction::create([
                'user_id' => $user->id,
                'points' => -$txn->points,
                'type' => 'expired',
                'booking_id' => $booking->id,
            ]);
        }
        
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully.');
    }

    public function resendTicket(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        $payment = $booking->payment;
        if (!$payment) {
            $payment = Payment::where('booking_id', $booking->id)->first();
        }

        if (!$payment) {
            return back()->with('error', 'No payment found for this booking.');
        }

        Mail::to($request->email)
            ->sendNow(new BookingTicketMail($booking, $payment, $request->email));

        return redirect()->route('bookings.index')->with('success', __('Ticket resent successfully to :email', ['email' => $request->email]));
    }
}