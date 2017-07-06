<?php

namespace App\Observers;

use App\Item;
use Illuminate\Support\Facades\Cache;

class ItemObserver {
	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(Item $item) {
		Cache::tags('items')->flush();
	}

	public function creating(Item $item) {
		foreach ($item->toArray() as $name => $value) {
			if (empty($value)) {
				$item->{$name} = null;
			}
		}
		return true;
	}

	/**
	 * Listen to the item deleting event.
	 *
	 * @param  item  $item
	 * @return void
	 */
	public function deleted(Item $item) {
		Cache::tags('items')->flush();
		Cache::forget('items_' . $item->id);
	}

	public function saving(Item $item) {
		foreach ($item->toArray() as $key => $value) {
			if ($value !== 0) {
				$item->{$key} = empty($value) ? null : $value;
			}
		}
	}

	/**
	 * Listen to the item deleting event.
	 *
	 * @param  item  $item
	 * @return void
	 */
	public function saved(Item $item) {
		Cache::forget('items_' . $item->id);
	}
}