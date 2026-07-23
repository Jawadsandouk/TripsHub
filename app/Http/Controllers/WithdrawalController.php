<?php

namespace App\Http\Controllers;

use App\Models\WithdrawalRequest;
use App\Services\Payments\PaymentFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function officeIndex()
    {
        $user = Auth::user();
        $withdrawals = WithdrawalRequest::where('office_id', $user->id)
            ->latest()
            ->paginate(20);
        $methods = PaymentFactory::methods();
        return view('office.withdrawals', compact('withdrawals', 'methods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_method' => ['required', 'string'],
        ]);

        $user = Auth::user();
        $methods = PaymentFactory::methods();

        if (!isset($methods[$request->payment_method])) {
            return back()->withErrors(['payment_method' => 'Invalid payment method.']);
        }

        $detailsRules = ['required', 'string', 'max:255'];

        if (in_array($request->payment_method, ['sham_cash', 'visa', 'mastercard'])) {
            $detailsRules[] = 'regex:/^\d{5}$/';
        } elseif (in_array($request->payment_method, ['syriatel_cash', 'mtn_cash'])) {
            $detailsRules[] = 'regex:/^\d{10}$/';
        }

        $request->validate([
            'payment_details' => $detailsRules,
        ]);

        WithdrawalRequest::create([
            'office_id' => $user->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_details' => $request->payment_details,
            'status' => 'pending',
        ]);

        return redirect()->route('office.withdrawals')->with('success', __('Withdrawal request submitted successfully.'));
    }

    public function ownerIndex(Request $request)
    {
        $query = WithdrawalRequest::with('office');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('office_name')) {
            $query->whereHas('office', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->office_name . '%');
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('payment_details')) {
            $query->where('payment_details', 'like', '%' . $request->payment_details . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $withdrawals = $query->latest()->paginate(20)->withQueryString();
        $currentStatus = $request->status;

        $totalTransferred = WithdrawalRequest::where('status', 'completed')->sum('amount');

        $methods = PaymentFactory::methods();

        return view('owner.withdrawals', compact(
            'withdrawals', 'currentStatus', 'totalTransferred', 'methods'
        ));
    }

    public function startProcessing(WithdrawalRequest $withdrawalRequest)
    {
        if ($withdrawalRequest->status !== 'pending') {
            return back()->withErrors(['error' => 'Request is not in pending status.']);
        }

        $withdrawalRequest->update(['status' => 'processing']);

        return redirect()->route('owner.withdrawals')->with('success', __('Withdrawal processing started.'));
    }

    public function complete(WithdrawalRequest $withdrawalRequest)
    {
        if ($withdrawalRequest->status !== 'processing') {
            return back()->withErrors(['error' => 'Request is not in processing status.']);
        }

        $withdrawalRequest->update(['status' => 'completed']);

        return redirect()->route('owner.withdrawals')->with('success', __('Withdrawal completed successfully.'));
    }

    public function reject(WithdrawalRequest $withdrawalRequest)
    {
        if (!in_array($withdrawalRequest->status, ['pending', 'processing'])) {
            return back()->withErrors(['error' => 'Request cannot be rejected.']);
        }

        $withdrawalRequest->update(['status' => 'rejected']);

        return redirect()->route('owner.withdrawals')->with('success', __('Withdrawal request rejected.'));
    }
}
