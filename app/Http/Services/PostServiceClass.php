<?php



namespace App\Http\Services;
use App\Models\Post;
use App\Models\Tag; 




class PostServiceClass
{
    public function getPostsWithCommentsAndTags()
    {
        $posts = \App\Models\Post::with(['comments', 'tags'])->get();
        return $posts;
    }

    public function createPostWithTags($title, $body, $userId, $tagIds)
 {

 $post = Post::create([//insert into posts table
            'title' => $title,
            'body' => $body,
            'user_id'=> $userId
        ]);


foreach ($tagIds as $tagId) {
            $tag = Tag::find($tagId);
            if (!$tag) {
                return response()->json(['error' => 'Tag not found'], 404);
            }
        }



        $post->tags()->attach($tagIds);//insert posts_tags

        return $post;
 }

 public function updatePost($postId, $title, $body)
 {

$post = Post::find($postId);

if (!$post){
    return false;
}

        $post->update([
            'title' => $title,
            'body' => $body,
        ]);


return $post;

 }

}
