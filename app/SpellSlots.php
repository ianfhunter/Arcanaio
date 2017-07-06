<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpellSlots extends Model {

	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $table = 'player_spell_slots';

	protected $primaryKey = 'player_id';

	protected $dates = ['deleted_at'];

	protected $guarded = ['player_id', 'created_at', 'updated_at', 'deleted_at'];

	public function player() {
		return $this->belongsTo('App\Player');
	}
}
