<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetitionApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DonationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- Public Routes (No Login Required) ---

// Authentication
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);

// Petitions
Route::get('/petitions', [PetitionApiController::class, 'index']);
Route::get('/petitions/{petition}', [PetitionApiController::class, 'show']);


// --- Protected Routes (Login Required) ---
Route::middleware('auth:sanctum')->group(function () {

    // Authentication
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::post('/delete-account', [AuthApiController::class, 'deleteAccount']);

    // User profile
    Route::post('/user/update', [AuthApiController::class, 'updateProfile']);
    Route::post('/user/change-password', [AuthApiController::class, 'changePassword']);
    Route::get('/user', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    });

    // Donations
    Route::get('/petitions/{petition}/donations', [DonationController::class, 'index']);
    Route::post('/petitions/{petition}/donations', [DonationController::class, 'store']);
});
