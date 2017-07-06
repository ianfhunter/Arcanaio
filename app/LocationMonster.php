<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationMonster extends Model
{
    protected $table = 'location_monsters';

    public function location()
    {
        return $this->belongsToMany('App\Location', 'location_monsters', 'monster_id','location_id');
    }
}