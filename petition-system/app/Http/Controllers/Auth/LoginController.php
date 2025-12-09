<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication (login) request.
     */
    public function store(Request $request)
    {
        // 1. Validate the form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to log the user in
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // 3. Regenerate the session ID for security
            $request->session()->regenerate();

            // 4. Redirect to the intended page or home
            return redirect()->intended(route('home'))->with('success', 'Login successful! Welcome back.');
        }

        // 5. If login fails, redirect back with an error
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Log the user out.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))->with('logout', 'You have been logged out successfully.');
    }
}