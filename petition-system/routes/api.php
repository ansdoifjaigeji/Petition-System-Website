<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetitionApiController;
use App\Http\Controllers\Api\AuthApiController; // <-- Import the new controller

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- Public Routes (No Login Required) ---

// Login
Route::post('/login', [AuthApiController::class, 'login']);
// Register
Route::post('/register', [AuthApiController::class, 'register']);

// Get Petitions
Route::get('/petitions', [PetitionApiController::class, 'index']);
Route::get('/petitions/{id}', [PetitionApiController::class, 'show']);


// --- Protected Routes (Login Required) ---

Route::middleware('auth:sanctum')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthApiController::class, 'logout']);

    // Get Current User Profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});