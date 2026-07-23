<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class PublicTripController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::whereIn('status', ['open', 'finished', 'paused'])
            ->with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('place_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('min_price')) {
            $query->where('seat_price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('seat_price', '<=', $request->max_price);
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        $sort = $request->get('sort', 'departure');
        if ($sort === 'price') {
            $query->orderBy('seat_price', 'asc');
        } elseif ($sort === 'rating') {
            $query->withCount('ratings')->orderByDesc('ratings_count');
        } else {
            $query->orderBy('departure_time', 'asc');
        }

        $trips = $query->paginate(12);

        return view('trips.public', compact('trips'));
    }
}
