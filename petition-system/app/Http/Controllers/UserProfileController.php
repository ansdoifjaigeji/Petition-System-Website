<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserProfileController extends Controller
{
    // 1. Profile Dashboard
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // 2. Account Settings
    public function settings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    // 3. Update Preferences (e.g., dark mode)
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'dark_mode' => 'nullable|in:1',
        ]);

        $user->dark_mode = isset($validated['dark_mode']) && $validated['dark_mode'] == '1';
        $user->save();

        // If request expects JSON (AJAX), return JSON response
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'dark_mode' => (bool)$user->dark_mode]);
        }

        return redirect()->back()->with('success', 'Preferences updated.');
    }
}