<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationItem extends Model
{
    protected $table = 'location_items';

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}