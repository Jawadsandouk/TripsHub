<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Trip $trip)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $tripEnded = $trip->status === 'finished';

        if (!$tripEnded) {
            return back()->with('error', 'You can only rate trips after they are finished.');
        }

        $hasBooked = $trip->bookings()
            ->where('user_id', Auth::id())
            ->exists();

        if (!$hasBooked) {
            return back()->with('error', 'You must book this trip before rating.');
        }

        $existing = Rating::where('user_id', Auth::id())
            ->where('trip_id', $trip->id)
            ->first();

        if ($existing) {
            $existing->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = 'Rating updated successfully.';
        } else {
            Rating::create([
                'user_id' => Auth::id(),
                'trip_id' => $trip->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = 'Thank you for rating!';
        }

        return back()->with('success', $message);
    }

    public function tripRating(Trip $trip)
    {
        return Rating::with('user')
            ->where('trip_id', $trip->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}