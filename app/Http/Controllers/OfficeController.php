<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'office')->withCount(['trips']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->get('sort') === 'rating') {
            $query->orderByDesc('trips_count');
        } else {
            $query->orderBy('name');
        }

        $offices = $query->paginate(12);

        return view('offices.index', compact('offices'));
    }

    public function show(User $office)
    {
        if ($office->role !== 'office') {
            abort(404);
        }

        $trips = $office->trips()
            ->orderBy('departure_time')
            ->paginate(10);

        $avgRating = $office->averageRating();
        $ratingCount = $office->ratingCount();

        return view('offices.show', compact('office', 'trips', 'avgRating', 'ratingCount'));
    }
}