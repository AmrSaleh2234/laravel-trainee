<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TagServiceClass;

class TagController extends Controller


{

    public TagServiceClass $service;

    public function __construct()
    {

        $this->service = new TagServiceClass();
    }

    public function index()
    {
        $tags = $this->service->getAllTags();

        return response()->json($tags);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = $this->service->createTag($request->name);

        return response()->json($tag, 201);
    }
}
