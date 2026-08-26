<?php



namespace App\Http\Services;

use App\Models\Post;
use App\Models\Tag;
use App\Http\Repositories\PostRepositoreyClass;
use Illuminate\Support\Facades\DB;





class PostServiceClass
{

    public PostRepositoreyClass $repository;

    public function __construct()
    {
        $this->repository = new PostRepositoreyClass();
    }
    public function getPostsWithCommentsAndTags()
    {
        $posts = $this->repository->getPostsWithCommentsAndTags();
        return $posts;
    }

    public function createPostWithTags($title, $body, $userId, $tagIds)
    {

        $post = Post::create([ //insert into posts table
            'title' => $title,
            'body' => $body,
            'user_id' => $userId
        ]);
$post->addMediaFromRequest('photo')->toMediaCollection('post_images');

        foreach ($tagIds as $tagId) {
            $tag = Tag::find($tagId);
            if (!$tag) {
                return response()->json(['error' => 'Tag not found'], 404);
            }
        }


        $post->tags()->attach($tagIds); //insert posts_tags

        return Post::where("id",$post->id)->with("media")->first();
    }

    public function updatePost($postId, $title, $body)
    {

    DB::transaction(function () use ($postId, $title, $body) {

        $post = $this->repository->findPostById($postId);

        if (!$post) {
            return false;
        }

       $post = $this->repository->updatePost($postId, $title, $body);   

        return $post;


    
    });
    return true ;


    }



    public function detachTagsFromPost($postId)
    {


        $post = $this->repository->findPostById($postId);

        if (!$post) {
            return false;
        }

        $post->tags()->detach();

        return true;
    }
}
