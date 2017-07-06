<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NpcAbility extends Model
{
    protected $table = 'npc_abilities';

    public function npc()
    {
        return $this->belongsTo('App\Npc');
    }
}
