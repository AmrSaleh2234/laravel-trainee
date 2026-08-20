<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
     $tags=\App\Models\Tag::all();
        return response()->json($tags);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = \App\Models\Tag::create($validated);

        return response()->json($tag, 201);
    }
}
