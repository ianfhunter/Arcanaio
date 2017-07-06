<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationNpc extends Model
{
    protected $table = 'location_npcs';

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}