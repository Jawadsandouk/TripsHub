<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    const COMMISSION_RATE = 0.10;

    public function officeIndex()
    {
        $user = Auth::user();
        $tripIds = Trip::where('user_id', $user->id)->pluck('id');

        $grossRevenue = Booking::whereIn('trip_id', $tripIds)->sum('total_price');
        $totalBookings = Booking::whereIn('trip_id', $tripIds)->count();
        $avgBookingValue = Booking::whereIn('trip_id', $tripIds)->avg('total_price') ?? 0;
        $totalTrips = $tripIds->count();

        $commissionRate = self::COMMISSION_RATE;

        $totalCommission = $grossRevenue * $commissionRate;
        $netRevenue = $grossRevenue - $totalCommission;

        $withdrawableBalance = $netRevenue - (float) WithdrawalRequest::where('office_id', $user->id)
            ->where('status', 'completed')
            ->sum('amount');

        $trips = Trip::where('user_id', $user->id)
            ->withCount(['bookings as total_bookings' => function ($q) {
                $q->select(DB::raw('COALESCE(SUM(number_of_seats), 0)'));
            }])
            ->withSum('bookings', 'total_price')
            ->get()
            ->map(function ($trip) use ($commissionRate) {
                $gross = (float) ($trip->bookings_sum_total_price ?? 0);
                $commission = $gross * $commissionRate;
                return (object) [
                    'id' => $trip->id,
                    'name' => $trip->getTranslatedName(),
                    'bookings_count' => $trip->bookings()->count(),
                    'total_seats' => (int) $trip->total_bookings,
                    'gross_revenue' => $gross,
                    'commission_amount' => $commission,
                    'net_revenue' => $gross - $commission,
                    'status' => $trip->status,
                ];
            });

        $paymentStats = Booking::whereIn('trip_id', $tripIds)
            ->select('payment_status', DB::raw('COUNT(*) as count'), DB::raw('COALESCE(SUM(total_price), 0) as revenue'))
            ->groupBy('payment_status')
            ->get()
            ->map(function ($stat) use ($commissionRate) {
                $stat->gross_revenue = (float) $stat->revenue;
                $stat->commission_amount = $stat->gross_revenue * $commissionRate;
                $stat->net_revenue = $stat->gross_revenue - $stat->commission_amount;
                return $stat;
            });

        $withdrawals = WithdrawalRequest::where('office_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('office.financials', compact(
            'totalBookings', 'avgBookingValue', 'totalTrips',
            'trips', 'paymentStats', 'withdrawableBalance', 'withdrawals'
        ) + ['totalRevenue' => $netRevenue]);
    }

    public function ownerIndex()
    {
        $grossRevenue = Booking::sum('total_price');
        $totalBookings = Booking::count();
        $totalOffices = User::where('role', 'office')->count();
        $totalTrips = Trip::count();

        $commissionRate = self::COMMISSION_RATE;

        $totalCommission = $grossRevenue * $commissionRate;
        $netRevenue = $grossRevenue - $totalCommission;

        $pendingWithdrawalsCount = WithdrawalRequest::where('status', 'pending')->count();

        $offices = User::where('role', 'office')
            ->with(['trips' => function ($q) {
                $q->withCount('bookings')->withSum('bookings', 'total_price');
            }])
            ->get()
            ->map(function ($office) use ($commissionRate) {
                $trips = $office->trips;
                $gross = (float) $trips->sum('bookings_sum_total_price');
                $commission = $gross * $commissionRate;
                return (object) [
                    'id' => $office->id,
                    'name' => $office->name,
                    'trips_count' => $trips->count(),
                    'bookings_count' => $trips->sum('bookings_count'),
                    'gross_revenue' => $gross,
                    'commission_amount' => $commission,
                    'net_revenue' => $gross - $commission,
                ];
            });

        $paymentStats = Booking::select('payment_status', DB::raw('COUNT(*) as count'), DB::raw('COALESCE(SUM(total_price), 0) as revenue'))
            ->groupBy('payment_status')
            ->get()
            ->map(function ($stat) use ($commissionRate) {
                $stat->gross_revenue = (float) $stat->revenue;
                $stat->commission_amount = $stat->gross_revenue * $commissionRate;
                $stat->net_revenue = $stat->gross_revenue - $stat->commission_amount;
                return $stat;
            });

        return view('owner.financials', compact(
            'totalBookings', 'totalOffices', 'totalTrips',
            'offices', 'paymentStats', 'pendingWithdrawalsCount',
            'grossRevenue', 'totalCommission'
        ) + ['totalRevenue' => $netRevenue]);
    }
}
