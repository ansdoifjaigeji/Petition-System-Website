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
        // Show the login form (blade view). This is the GET route for /log-in
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

        // 2. Attempt to log the user in using Laravel's Auth facade.
        // If credentials are valid, a session is created for browser clients.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // 3. Regenerate the session ID for security
            $request->session()->regenerate();

            // 4. If JSON is expected (API/AJAX), return a JSON payload so JS clients
            // can handle the response without a redirect.
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => auth()->user()->only(['id', 'name', 'email', 'dark_mode']),
                ]);
            }

            // Otherwise redirect to the intended page or home
            return redirect()->intended(route('home'))->with('success', 'Login successful! Welcome back.');
        }

        // 5. If login fails, return validation error. For API clients we return
        // a JSON 422 with the validation message, while browser clients will
        // get a normal ValidationException causing a redirect back to the form.
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'errors' => ['email' => [__('auth.failed')]],
            ], 422);
        }

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