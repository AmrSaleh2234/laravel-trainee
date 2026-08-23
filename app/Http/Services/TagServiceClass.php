<?php

namespace App\Http\Services;

use App\Models\Tag;

class TagServiceClass

{

    public function getAllTags()
    {

        $tags = \App\Models\Tag::all();

        return $tags;
    }

    public function createTag($name)
    {
        $tag = \App\Models\Tag::create([
            'name' => $name
        ]);
        return $tag;
    }


}
