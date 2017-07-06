<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'social_id', 'avatar',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function campaigns() {
		return $this->hasMany('App\Campaign');
	}

	public function players() {
		return $this->hasMany('App\Player');
	}

	public function combats() {
		return $this->hasMany('App\Combat');
	}

	public function monsters() {
		return $this->hasMany('App\Monster');
	}

	public function likes() {
		return $this->hasMany('App\Like');
	}

	public function comments() {
		return $this->hasMany('App\Comment');
	}

	function following() {
		return $this->belongsToMany('App\User', 'followers', 'user_id', 'following_id')->withTimestamps();
	}

	function followers() {
		return $this->belongsToMany('App\User', 'followers', 'following_id', 'user_id')->withTimestamps();
	}

	public function isFollowedBy(User $otherUser) {
		$idsWhoOtherUserFollows = $otherUser->following()->pluck('following_id')->all();
		return in_array($this->id, $idsWhoOtherUserFollows);
	}
	public function getNameAttribute($value) {
		if ($this->deleted_at != NULL) {
			$value = "Deleted User";
			return $value;
		} else {
			return $value;
		}
	}
	public function getAvatarAttribute($value) {
		if ($this->deleted_at != NULL) {
			$value = "/img/avatar.jpg";
			return $value;
		} else {
			return $value;
		}
	}
}
