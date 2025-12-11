<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Make sure to import the User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // For hashing the password
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        // Display the registration form (GET /register)
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Create the new user in the database
        // Password is hashed before storing to keep credentials secure
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Always hash passwords
        ]);

        // 3. Log the new user in
        // After registration we sign the user in (session-based) so they can
        // continue to the app immediately without a separate login step.
        Auth::login($user);

        // 4. Redirect them to the home page
        return redirect(route('home'));
    }
}