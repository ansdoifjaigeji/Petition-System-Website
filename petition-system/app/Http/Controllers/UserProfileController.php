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
}