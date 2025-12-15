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

// Petition Routes (Public)
Route::get('/explore', [PetitionController::class, 'index'])->name('petitions.index');
Route::get('/petitions/{id}', [PetitionController::class, 'show'])->name('petitions.show');
Route::post('/petitions/{id}/sign', [App\Http\Controllers\SignatureController::class, 'store'])->name('petition.sign');

// Petition Routes (Only logged-in users)
Route::middleware('auth')->group(function () {

    // Start petition
    Route::get('/start-petition', [PetitionController::class, 'create'])->name('petitions.create');
    Route::post('/start-petition', [PetitionController::class, 'store'])->name('petitions.store');

    // Edit / Update / Delete petition
    Route::get('/petitions/{id}/edit', [PetitionController::class, 'edit'])->name('petitions.edit');
    Route::put('/petitions/{id}', [PetitionController::class, 'update'])->name('petitions.update');
    Route::delete('/petitions/{id}', [PetitionController::class, 'destroy'])->name('petitions.destroy');


    // User profile routes
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/settings', [UserProfileController::class, 'settings'])->name('profile.settings');

    Route::post('/settings/preferences', [UserProfileController::class, 'updatePreferences'])->name('profile.preferences.update');
    Route::post('/settings/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/settings/password', [UserProfileController::class, 'changePassword'])->name('profile.password.update');
    Route::post('/settings/delete-account', [UserProfileController::class, 'deleteAccount'])->name('profile.delete-account');

    // Logout
    Route::post('/log-out', [LoginController::class, 'destroy'])->name('logout');

    // Delete a comment from a signature (only by owner)
    Route::delete('/signatures/{id}/comment', [App\Http\Controllers\SignatureController::class, 'destroyComment'])->name('signature.comment.destroy');
});

// Authentication Routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/log-in', [LoginController::class, 'create'])->name('login');
    Route::post('/log-in', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});
