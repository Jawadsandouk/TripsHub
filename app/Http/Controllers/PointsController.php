<?php

namespace App\Http\Controllers;

use App\Models\PointTransaction;
use Illuminate\Support\Facades\Auth;

class PointsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = PointTransaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $totalPoints = $user->points;

        return view('user.points', compact('transactions', 'totalPoints'));
    }
}
