<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

    
    /**
     * Get all of the owning likeable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
}
