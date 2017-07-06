<?php

namespace App;

use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Spell extends Model implements TaggableInterface {
	use SoftDeletes;
	use Searchable;
	use TaggableTrait;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */

	protected $dates = ['deleted_at'];

	protected $guarded = ['id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

	public function toSearchableArray() {

		$data['id'] = $this->id;
		$data['name'] = $this->name;
		$data['description'] = $this->description;
		$data['class'] = $this->class;
		$data['school'] = $this->school;
		$data['level'] = $this->level;
		$data['created_at'] = $this->created_at;
		$data['source'] = $this->source;
		$data['view_count'] = $this->view_count;
		$data['like_count'] = $this->like_count;
		$data['user_name'] = $this->user->name;
		$data['user_id'] = $this->user->id;
		$data['user_avatar'] = $this->user->avatar;
		$data['description_short'] = str_limit(strip_tags($this->description), 240);
		$data['class'] = explode(', ', $this->class);
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

	public function forkedFrom() {
		return $this->belongsTo('App\Spell', 'fork_id');
	}

	public function forkedTo() {
		return $this->hasMany('App\Spell', 'fork_id');
	}

	public function getIsLikedAttribute() {
		$like = $this->likes()->whereUserId(\Auth::id())->first();
		return (!is_null($like)) ? true : false;
	}

	public function scopeOfLevel($query, $level) {
		return $query->where('level', $level);
	}

	public function user() {
		return $this->belongsTo('App\User')->withTrashed();
	}
}
