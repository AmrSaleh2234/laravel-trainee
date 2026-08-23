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
        $post = Post::create([//insert into posts table
            'title' => $request->title,
            'body' => $request->body,
            'user_id'=>auth()->user()->id
        ]);


foreach ($request->tag_ids as $tagId) {
            $tag = Tag::find($tagId);
            if (!$tag) {
                return response()->json(['error' => 'Tag not found'], 404);
            }
        }



        $post->tags()->attach($request->tag_ids);//insert posts_tags

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json($post);
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
}
