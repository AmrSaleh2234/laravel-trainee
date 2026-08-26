<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;      
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'title',
        'body',
        "user_id"

    ];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_posts');
    }
}