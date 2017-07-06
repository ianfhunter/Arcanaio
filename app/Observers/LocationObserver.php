<?php

namespace App\Observers;

use App\Location;
use Illuminate\Support\Facades\Cache;

class LocationObserver {
	public function creating(Location $location) {
		foreach ($location->toArray() as $name => $value) {
			if (empty($value)) {
				$location->{$name} = null;
			}
		}
		return true;
	}

	/**
	 * Listen to the User created event.
	 *
	 * @param  User  $user
	 * @return void
	 */
	public function created(Location $location) {
		Cache::tags('locations')->flush();
	}

	/**
	 * Listen to the location deleting event.
	 *
	 * @param  location  $location
	 * @return void
	 */
	public function deleted(Location $location) {
		Cache::tags('locations')->flush();
		Cache::forget('locations_' . $location->id);
	}

	/**
	 * Listen to the location deleting event.
	 *
	 * @param  location  $location
	 * @return void
	 */
	public function saved(Location $location) {
		Cache::forget('locations_' . $location->id);
	}

	public function saving(Location $location) {
		foreach ($location->toArray() as $key => $value) {
			if ($value !== 0) {
				$location->{$key} = empty($value) ? null : $value;
			}
		}
	}
}