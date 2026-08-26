<?php

namespace App\Http\Controllers;

use App\Http\Services\PostServiceClass;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;



class PostController extends Controller
{
    public PostServiceClass $service;

    public function __construct()
    {
        $this->service = new PostServiceClass();
    }
    public function index()
    {
        $posts = $this->service->getPostsWithCommentsAndTags();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return response()->json($post);
    }

    public function store(Request $request)
    {

        $post = $this->service->createPostWithTags($request->title, $request->body, auth()->user()->id, $request->tag_ids);



        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = $this->service->updatePost($id, $request->title, $request->body);

        if (!$post) {

            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json("Post updated successfully");
    }
    public function destroy($id)
    {

        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function comments($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $comments = Comment::where('post_id', $id)->get();
        // $comments = $post->comments;

        return response()->json($comments);
    }


    public function detachTag($id)
    {
        $post = $this->service->detachTagsFromPost($id);

        if (!$post) {

            return response()->json(['error' => 'post not found'], 404);
        }

        return response()->json(['message' => 'Tags detached successfully']);
    }




    
}
