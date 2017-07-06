<?php

namespace App;

use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Npc extends Model implements TaggableInterface {
	use SoftDeletes;
	use Searchable;
	use TaggableTrait;

	protected $dates = ['deleted_at'];

	protected $guarded = ['id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

	public function toSearchableArray() {

		$data['id'] = $this->id;
		$data['name'] = $this->name;
		$data['description'] = $this->description;
		$data['race'] = $this->race ? $this->race : 'None';
		$data['alignment'] = ucwords($this->alignment);
		$data['profession'] = $this->profession ? $this->profession : 'No Profession';
		$data['created_at'] = $this->created_at;
		$data['source'] = $this->source;
		$data['view_count'] = $this->view_count;
		$data['like_count'] = $this->like_count;
		$data['user_name'] = $this->user->name;
		$data['user_id'] = $this->user->id;
		$data['user_avatar'] = $this->user->avatar;
		$data['description_short'] = str_limit(strip_tags($this->description), 240);
		$data['comment_count'] = $this->comments->count();
		if ($this->private != 1) {
			$data['_tags'] = ['user_' . $this->user->id, 'public'];
		} else {
			$data['_tags'] = ['user_' . $this->user->id];
		}

		return $data;
	}

	public function likes() {
		return $this->morphMany('App\Like', 'likeable');
	}

	public function comments() {
		return $this->morphMany('App\Comment', 'commentable');
	}

	public function private_notes() {
		return $this->morphMany('App\Note', 'noteable');
	}

	public function files() {
		return $this->morphMany('App\File', 'fileable');
	}

	public function campaigns() {
		return $this->morphToMany('App\Campaign', 'campaignable');
	}

	public function forkedFrom() {
		return $this->belongsTo('App\Npc', 'fork_id');
	}

	public function forkedTo() {
		return $this->hasMany('App\Npc', 'fork_id');
	}

	public function getIsLikedAttribute() {
		$like = $this->likes()->whereUserId(\Auth::id())->first();
		return (!is_null($like)) ? true : false;
	}

	public function user() {
		return $this->belongsTo('App\User')->withTrashed();
	}

	public function abilities() {
		return $this->hasMany('App\NpcAbility');
	}

	public function actions() {
		return $this->hasMany('App\NpcAction');
	}

	public function spells() {
		return $this->belongsToMany('App\Spell', 'npc_spells', 'npc_id', 'spell_id')->withPivot('level')->withTimestamps();
	}

	public function locations() {
		return $this->belongsToMany('App\Location', 'location_npcs', 'npc_id', 'location_id');
	}

	public function latestNote() {
		return $this->hasOne('App\Note')->orderBy('updated_at', 'desc');
	}
}
