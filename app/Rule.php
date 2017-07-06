<?php

namespace App;

use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Rule extends Model implements TaggableInterface {
	use SoftDeletes;
	use TaggableTrait;
	use Searchable;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function toSearchableArray() {

		if ($this->id != 20) {
			$data['id'] = $this->id;
			$data['name'] = $this->name;
			$data['slug'] = $this->slug;
			$data['description'] = $this->description;
			$data['summary'] = str_limit($this->summary, 240);
			$data['parent'] = $this->parent;
			$data['source'] = $this->source;
			$data['system'] = $this->system;
			$data['_tags'] = ['public'];
			return $data;
		}

	}

}
