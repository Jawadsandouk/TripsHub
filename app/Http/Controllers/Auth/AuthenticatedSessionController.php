<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create($role): View|\Illuminate\Http\RedirectResponse
    {
        if (auth()->check()) {
            auth()->guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/login/' . $role);
        }

        return view('auth.login', compact('role'));
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = auth()->user()->role;
        if ($role === 'office') {
            return redirect()->route('office.dashboard');
        } elseif ($role === 'owner') {
            return redirect()->route('owner.dashboard');
        } elseif ($role === 'admin') {
            return redirect()->route('owner.offices');
        }

        return redirect()->route('user.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}