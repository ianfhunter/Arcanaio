<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterAbility extends Model
{
    protected $table = 'monster_abilities';

    public function monster()
    {
        return $this->belongsTo('App\Monster');
    }
}
