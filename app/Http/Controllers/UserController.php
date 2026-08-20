<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;

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



    //GET all users
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

public function show($id)
{
    $user = User::find($id);

    return response()->json($user);
}

public function update(Request $request, $id)
{
    $user = User::find($id);

    $user->update([
        'name' => $request->has('name') ? $request->name : $user->name,
        'email' => $request->has('email') ? $request->email : $user->email,
        'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
    ]);

    return response()->json($user);

}


public function delete($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }

}


public function getUserPosts($id)
{
    
    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // $posts = $user->posts;
    $posts =Post::where('user_id', $id)->with("comments")->get();

    return response()->json($posts);
}
}
