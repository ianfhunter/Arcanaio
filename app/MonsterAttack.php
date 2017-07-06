<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterAttack extends Model
{
    protected $table = 'monster_attacks';

    public function attack()
    {
        return $this->belongsTo('App\Monster');
    }
}
