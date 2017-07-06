<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NpcAction extends Model
{
    protected $table = 'npc_actions';

    public function npc()
    {
        return $this->belongsTo('App\Npc');
    }
}
