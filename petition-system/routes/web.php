<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Static Page Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');

// Petition Routes
Route::get('/explore', [PetitionController::class, 'index'])->name('petitions.index');
Route::get('/start-petition', [PetitionController::class, 'create'])->name('petitions.create');
Route::post('/start-petition', [PetitionController::class, 'store'])->name('petitions.store');
// You'll add this route later to handle the form submission
// Route::post('/start-petition', [PetitionController::class, 'store'])->name('petitions.store');


// Authentication Routes
// 'guest' middleware means only unauthenticated users can see it
Route::get('/log-in', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/log-in', [LoginController::class, 'store'])->middleware('guest')->name('login.store');
Route::post('/log-out', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');


// --- Add these new registration routes ---
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

// 'auth' middleware means only logged-in users can access it
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/settings', [UserProfileController::class, 'settings'])->name('profile.settings');

    // Profile settings: preferences, profile update, password change, delete
    Route::post('/settings/preferences', [UserProfileController::class, 'updatePreferences'])->name('profile.preferences.update');
    Route::post('/settings/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/settings/password', [UserProfileController::class, 'changePassword'])->name('profile.password.update');
    Route::post('/settings/delete-account', [UserProfileController::class, 'deleteAccount'])->name('profile.delete-account');
});
