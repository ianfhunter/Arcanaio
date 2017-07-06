<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(\Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
