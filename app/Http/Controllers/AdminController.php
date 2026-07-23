<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'trips' => Trip::count(),
            'bookings' => Booking::count(),
            'offices' => User::where('role', 'office')->count(),
        ];
        return view('owner.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('owner.users', compact('users'));
    }

    public function trips()
    {
        $trips = Trip::with('user')->latest()->paginate(20);
        return view('owner.trips', compact('trips'));
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'trip'])->latest()->paginate(20);
        return view('owner.bookings', compact('bookings'));
    }

    public function offices()
    {
        $offices = User::where('role', 'office')->with('trips')->latest()->paginate(20);
        return view('owner.offices', compact('offices'));
    }

    public function createUser($role)
    {
        if (!in_array($role, ['user', 'office', 'admin', 'owner'])) {
            abort(404);
        }
        return view('owner.create-user', compact('role'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,office,admin,owner'],
            'num1' => ['required', 'string', 'max:20'],
            'num2' => ['required', 'string', 'max:20'],
        ]);

        $role = $request->role;
        $currentUser = $request->user();

        if ($currentUser->role === 'admin' && $role !== 'office') {
            return redirect()->back()->with('error', __('Admins can only create office accounts.'))->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'num1' => $request->num1,
            'num2' => $request->num2,
        ]);

        $redirect = $currentUser->role === 'admin' ? 'owner.offices' : 'owner.users';
        return redirect()->route($redirect)->with('success', __('User created'));
    }

    public function togglePause(Trip $trip)
    {
        if ($trip->status === 'paused') {
            $trip->update(['status' => 'open']);
        } else {
            $trip->update(['status' => 'paused']);
        }

        return redirect()->route('owner.trips')->with('success', __('Trip status updated'));
    }

    public function cancelTrip(Trip $trip)
    {
        if ($trip->status !== 'open') {
            return redirect()->route('owner.trips')->with('error', 'Can only cancel open trips.');
        }

        $trip->update(['status' => 'canceled']);

        return redirect()->route('owner.trips')->with('success', __('Trip canceled'));
    }

    public function reopenTrip(Trip $trip)
    {
        if ($trip->status !== 'canceled') {
            return redirect()->route('owner.trips')->with('error', 'Can only reopen canceled trips.');
        }

        $trip->update(['status' => 'open']);

        return redirect()->route('owner.trips')->with('success', __('Trip reopened'));
    }

    public function togglePauseUser(User $user)
    {
        $user->update(['is_paused' => !$user->is_paused]);

        $status = $user->is_paused ? 'paused' : 'unpaused';
        return redirect()->back()->with('success', "User {$status} successfully");
    }

    public function destroyUser(User $user)
    {
        if ($user->role === 'owner') {
            return redirect()->route('owner.users')->with('error', 'Owner accounts can only be deleted from their profile.');
        }

        $user->delete();
        return redirect()->route('owner.users')->with('success', 'User deleted');
    }

    public function destroyTrip(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('owner.trips')->with('success', 'Trip deleted');
    }

    public function updateGlobalDiscount(Request $request)
    {
        $request->validate([
            'global_discount' => 'required|numeric|min:0|max:50',
        ]);

        DB::table('settings')
            ->where('key', 'global_discount')
            ->update(['value' => $request->global_discount]);

        return redirect()->back()->with('success', 'Global discount updated');
    }

    public function updateOfficeDiscount(Request $request, User $user)
    {
        $request->validate([
            'discount' => 'nullable|numeric|min:0|max:50',
        ]);

        $user->update(['discount' => $request->discount]);

        return redirect()->back()->with('success', 'Office discount updated');
    }
}