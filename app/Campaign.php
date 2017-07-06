<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;
    
    public function monsters()
    {
        return $this->morphedByMany('App\Monster', 'campaignable')->withTimestamps();
    }

    public function locations()
    {
        return $this->morphedByMany('App\Location', 'campaignable')->withTimestamps();
    }

    public function encounters()
    {
        return $this->morphedByMany('App\Encounter', 'campaignable')->withTimestamps();
    }

    public function npcs()
    {
        return $this->morphedByMany('App\Npc', 'campaignable')->withTimestamps();
    }

    public function items()
    {
        return $this->morphedByMany('App\Item', 'campaignable')->withTimestamps();
    }

    public function players()
    {
        return $this->morphedByMany('App\Player', 'campaignable')->withTimestamps();
    }

    public function journals()
    {
        return $this->hasMany('App\Journal');
    }

    public function user()
    {
        return $this->belongsTo('App\User')->withTimestamps();
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }

}
