<?php

namespace App;

use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Item extends Model implements TaggableInterface {
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
		$data['rarity'] = $this->rarity;
		$data['rarity_color'] = \ItemHelper::getRarityColor($this->rarity);
		$data['type'] = $this->type;
		$data['subtype'] = $this->subtype;
		$data['source'] = $this->source;
		$data['view_count'] = $this->view_count;
		$data['like_count'] = $this->like_count;
		$data['created_at'] = $this->created_at;
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

	public function forkedFrom() {
		return $this->belongsTo('App\Item', 'fork_id');
	}

	public function forkedTo() {
		return $this->hasMany('App\Item', 'fork_id');
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

	public function getIsLikedAttribute() {
		$like = $this->likes()->whereUserId(\Auth::id())->first();
		return (!is_null($like)) ? true : false;
	}

	public function user() {
		return $this->belongsTo('App\User')->withTrashed();
	}

	public function locations() {
		return $this->belongsToMany('App\Location', 'location_items', 'item_id', 'location_id');
	}

	public function getTypeAttribute($value) {
		return ucfirst($value);
	}

	public function getSubtypeAttribute($value) {
		return ucfirst($value);
	}

	public function getRarityAttribute($value) {
		return ucfirst($value);
	}

	public function scopeOfType($query, $type) {
		return $query->where('type', $type);
	}

	public function scopeMisc($query) {
		return $query->whereIn('type', ['Adventure Gear', 'Gear', 'Gaming Set', 'Tool', 'Ammo', 'Arcane Focus', 'Druidic Focus', 'Instrument', 'Vehicle', 'Mundane', 'Gem']);
	}

	public function scopeMagic($query) {
		return $query->whereIn('type', ['Rod', 'Wand', 'Staff', 'Ring', 'Scroll', 'Wondrous']);
	}

}
