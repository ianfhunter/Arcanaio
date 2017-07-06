<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use SoftDeletes;
    
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}
