<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    function show($id)
    {
        $comment = Comment::find($id);
        return response()->json($comment);
    }
    function store(Request $request)
    {
        $post = Post::find($request->post_id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
        ]);

        return response()->json($comment);
    }
function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
    function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $comment->update([
            'body' => $request->body,
        ]);

        return response()->json($comment);
    }

}

