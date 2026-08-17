<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;

Route::get('/bookings', [BookingController::class, 'myBookings']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);