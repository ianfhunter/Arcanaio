<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feed extends Model
{
    use SoftDeletes;

     protected $table = 'feed';

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
