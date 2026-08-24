

<?php

namespace App\Http\Repositories;





class PostRepositoreyClass
{
    public function getPostsWithCommentsAndTags()
    {
        $posts = \App\Models\Post::with(['comments', 'tags'])->get();
        return $posts;
    }

    public function createPostWithTags($title, $body, $userId, $tagIds)
    {

        $post = \App\Models\Post::create([ //insert into posts table
            'title' => $title,
            'body' => $body,
            'user_id' => $userId
        ]);
    }
}
