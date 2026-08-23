<?php



namespace App\Http\Services;



class PostServiceClass
{
    public function getPostsWithCommentsAndTags()
    {
        $posts = \App\Models\Post::with(['comments', 'tags'])->get();
        return $posts;
    }
}
