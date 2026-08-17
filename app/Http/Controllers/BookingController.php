<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function myBookings(Request $request)
    {
        $name = $request->query('name');

        return response()->json([
            'message' => 'Request successful',
            'user' => $name
        ]);
    }
}