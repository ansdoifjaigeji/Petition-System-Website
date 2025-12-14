<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\DonationWebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Static Pages ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');

// --- Petitions ---
Route::get('/explore', [PetitionController::class, 'index'])->name('petitions.index');
Route::get('/start-petition', [PetitionController::class, 'create'])->name('petitions.create');
Route::post('/start-petition', [PetitionController::class, 'store'])->name('petitions.store');

// Petition detail page (use route model binding)
Route::get('/petitions/{petition}', [PetitionController::class, 'show'])->name('petitions.show');

// --- Donations (UI) ---
Route::middleware('auth')->group(function () {
    Route::get('/petitions/{petition}/donate', [DonationWebController::class, 'create'])
        ->name('donations.create');

    Route::post('/petitions/{petition}/donations', [DonationWebController::class, 'store'])
        ->name('donations.store');
});

// --- Authentication ---
Route::get('/log-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/log-in', [LoginController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');
Route::post('/log-out', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// --- Registration ---
Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');

// --- Authenticated User Routes ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/settings', [UserProfileController::class, 'settings'])->name('profile.settings');

    // Profile settings: preferences, profile update, password change, delete
    Route::post('/settings/preferences', [UserProfileController::class, 'updatePreferences'])->name('profile.preferences.update');
    Route::post('/settings/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/settings/password', [UserProfileController::class, 'changePassword'])->name('profile.password.update');
    Route::post('/settings/delete-account', [UserProfileController::class, 'deleteAccount'])->name('profile.delete-account');

    // Main app view
    Route::view('/app', 'app')->name('app'); 
});
