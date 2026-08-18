<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//wed

class UserController extends Controller
{
    function register()
    {
        $newUser = User::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => $request->input("password")
        ]);

        return $newUser;
    }

    function login(Request $request)
    {
        $user = User::where("email", $request->input("email"))
            ->where("password", $request->input("password"))
            ->first();

        if ($user) {
            return response()->json([
                "message" => "Login successful",
                "user" => $user
            ]);
        } else {
            return response()->json([
                "message" => "Invalid credentials"
            ], 401);
        }
    }
}
