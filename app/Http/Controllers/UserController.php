<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//wed

class UserController extends Controller
{
    function register(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6"
        ]);

        $newUser = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"])
        ]);

        return response()->json([
            "message" => "User registered successfully",
            "user" => $newUser
        ], 201);
    }

    function login(Request $request)
    {
        $user = User::where("email", $request->input("email"))
            ->first();
        if ($user && Hash::check($request->input("password"), $user->password)) {
            $token = $user->createToken("git")->plainTextToken;
            return response()->json([
                "message" => "Login successful",
                "user" => $user,
                "token" => $token
            ]);
        } else {
            return response()->json([
                "message" => "Invalid credentials"
            ], 401);
        }
    }
}
