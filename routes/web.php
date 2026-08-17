<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('home');
});

Route::get('/bookings', [BookingController::class, 'myBookings'])
    ->middleware('api.key');