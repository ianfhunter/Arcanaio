<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model {
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */

	protected $dates = ['deleted_at'];

	protected $guarded = ['id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

	public function files() {
		return $this->morphMany('App\File', 'fileable');
	}

	public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}

	public function private_notes() {
		return $this->morphMany('App\Note', 'noteable');
	}

	public function campaigns() {
		return $this->morphToMany('App\Campaign', 'campaignable');
	}

	public function items() {
		return $this->belongsToMany('App\Item', 'inventories', 'player_id', 'item_id')->withPivot('quantity')->withTimestamps();
	}

	public function spells() {
		return $this->belongsToMany('App\Spell', 'spellbooks', 'player_id', 'spell_id')->withPivot('casts', 'prepared')->withTimestamps();
	}

	public function spell_slots() {
		return $this->hasOne('App\SpellSlots');
	}

	public function user() {
		return $this->belongsTo('App\User')->withTrashed();
	}
}
