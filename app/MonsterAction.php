<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterAction extends Model
{
    protected $table = 'monster_actions';

    public function monster()
    {
        return $this->belongsTo('App\Monster');
    }
}
