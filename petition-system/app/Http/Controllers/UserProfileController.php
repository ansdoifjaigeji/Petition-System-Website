<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserProfileController extends Controller
{
    // 1. Profile Dashboard
    public function show()
    {
        $user = Auth::user();
        // Load recent comments (signatures with comments) for the profile dashboard
        $comments = $user->signatures()->whereNotNull('comment')->with('petition')->orderBy('created_at', 'desc')->get();

        // Render the profile dashboard for the authenticated user.
        return view('profile.show', compact('user', 'comments'));
    }

    // 2. Account Settings
    public function settings()
    {
        $user = Auth::user();
        // Show account settings page. Preferences like `dark_mode` are
        // editable here and persisted to the users table.
        return view('profile.settings', compact('user'));
    }

    // 3. Update Preferences (e.g., dark mode)
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'dark_mode' => 'nullable|in:1',
        ]);

        // Save the boolean flag for dark mode. Casting in the User model
        // ensures this value behaves as a boolean when read later.
        $user->dark_mode = isset($validated['dark_mode']) && $validated['dark_mode'] == '1';
        $user->save();

        // If request expects JSON (AJAX), return JSON response
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'dark_mode' => (bool)$user->dark_mode]);
        }

        return redirect()->back()->with('success', 'Preferences updated.');
    }

    // 4. Update Profile (name, email)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'user' => $user]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // 5. Change Password
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    // 4. Delete Account
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        
        // Validate the password to ensure the user really wants to delete their account
        $validated = $request->validate([
            'password' => 'required|current_password',
        ]);

        // Log out the user and delete their account from the database
        Auth::logout();
        $user->delete();

        // Invalidate the session and regenerate token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to home with a confirmation message
        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }
}