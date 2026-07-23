<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create($role): View|\Illuminate\Http\RedirectResponse
    {
        if (auth()->check()) {
            auth()->guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/register/' . $role);
        }

        return view('auth.register', compact('role'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,office,admin'],
            'num1' => ['required', 'string', 'max:20'],
            'num2' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'num1' => $request->num1,
            'num2' => $request->num2,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $role = $user->role;
        if ($role === 'office') {
            return redirect()->route('office.dashboard');
        } elseif ($role === 'admin') {
            return redirect()->route('owner.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}