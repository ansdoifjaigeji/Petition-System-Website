<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    /**
     * Login via API (Returns a Token)
     */
    public function login(Request $request)
    {
        // 1. Validate incoming data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Find the user
        $user = User::where('email', $request->email)->first();

        // 3. Check password
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        // 4. Create a Sanctum personal access token. This persists a row
        // in `personal_access_tokens` and returns the raw token string which
        // the client must store securely (we show it in the JSON response).
        // The token name ('mobile-app') is arbitrary and useful for
        // identifying tokens in the DB later.
        $token = $user->createToken('mobile-app')->plainTextToken;

        // 5. Return the token and user data
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    }

    /**
     * Register via API (Creates user and returns token)
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // create token
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    /**
     * Logout via API (Revokes the Token)
     */
    public function logout(Request $request)
    {
        // Delete the token that was used to authenticate the current request
        // `currentAccessToken()` removes only the token provided in the
        // Authorization header; this is the typical method for logging out
        // a single API client without affecting other tokens.
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ], 200);
    }

    /**
     * Update profile via API (name, email)
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'user' => $user,
        ], 200);
    }

    /**
     * Change password via API
     */
    public function changePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully',
        ], 200);
    }

    /**
     * Delete Account via API
     * Requires password confirmation for security
     */
    public function deleteAccount(Request $request)
    {
        // Validate the password
        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user = $request->user();

        // Delete all tokens for this user (logout all sessions)
        $user->tokens()->delete();

        // Delete the user account from the database
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Your account has been deleted successfully.'
        ], 200);
    }
}