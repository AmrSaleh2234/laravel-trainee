<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/bookings', [BookingController::class, 'myBookings']);
    
});
