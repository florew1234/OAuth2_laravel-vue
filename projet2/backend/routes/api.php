<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'AuthController@user');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// provider route
Route::group(['middleware' => ['web']], function () {
    
    Route::get('login/github', [LoginController::class, 'redirectToProvider']);
    Route::get('github/callback', [LoginController::class, 'handleProviderCallback']);

    Route::get('login/google', [LoginController::class, 'redirectToGoogle']);
    Route::get('google/callback', [LoginController::class, 'handleGoogleCallback']);

    Route::get('login/linkedin', [LoginController::class, 'redirectToLinkedin']);
    Route::get('linkedin/callback', [LoginController::class, 'handleLinkedInCallback']);

    Route::get('login/facebook', [LoginController::class, 'redirectToFacebook']);
    Route::get('linkedin/callback', [LoginController::class, 'handleFacebookCallback']);
});






