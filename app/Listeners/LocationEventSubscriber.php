<?php

namespace App\Listeners;

use App\Feed;
use App\Location;
use App\Notifications\LocationCommented;
use App\Notifications\LocationForked;
use App\Notifications\LocationLiked;
use App\User;

class LocationEventSubscriber {

	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  itemCreated  $event
	 * @return void
	 */
	public function onLocationCreation($event) {

		$data = array('id' => $event->location->id, 'name' => $event->location->name, 'user_name' => $event->location->user->name, 'user_id' => $event->location->user_id, 'avatar' => $event->location->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->location->user_id;
		$feed->type = 'location_created';
		$feed->data = $data;
		$feed->private = $event->location->private;
		$feed->save();

	}

	public function onLocationFork($event) {

		if ($event->location->user_id != $event->forked->user->id) {
			$user = User::findOrFail($event->forked->user->id);
			$user->notify(new LocationForked($event->location, $event->forked, $event->location->user));
		}

		$data = array('id' => $event->location->id, 'name' => $event->location->name, 'user_name' => $event->location->user->name, 'user_id' => $event->location->user_id, 'avatar' => $event->location->user->avatar, 'forked_id' => $event->forked->id, 'forked_name' => $event->forked->name);

		$feed = new Feed;
		$feed->user_id = $event->location->user_id;
		$feed->type = 'location_forked';
		$feed->data = $data;
		$feed->private = $event->location->private;
		$feed->save();

	}

	public function onLocationComment($event) {
		$location = Location::findOrFail($event->comment->commentable_id);

		if ($event->comment->user_id != $location->user_id) {
			$user = User::findOrFail($location->user_id);
			$user->notify(new LocationCommented($location, $event->comment->user));
		}

		$data = array('id' => $location->id, 'name' => $location->name, 'user_name' => $event->comment->user->name, 'user_id' => $event->comment->user_id, 'body' => $event->comment->body);

		$feed = new Feed;
		$feed->user_id = $event->comment->user_id;
		$feed->type = 'location_comment';
		$feed->data = $data;
		$feed->save();
	}

	public function onLocationLike($event) {
		$location = Location::findOrFail($event->like->likeable_id);

		if ($event->like->user_id != $location->user_id) {
			$user = User::findOrFail($location->user_id);
			$user->notify(new LocationLiked($location, $event->like->user));
		}

		$data = array('id' => $location->id, 'name' => $location->name, 'user_name' => $event->like->user->name, 'user_id' => $event->like->user_id);

		$feed = new Feed;
		$feed->user_id = $event->like->user_id;
		$feed->type = 'location_like';
		$feed->data = $data;
		$feed->save();
	}

	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param  Illuminate\Events\Dispatcher  $events
	 */
	public function subscribe($events) {
		$events->listen(
			'App\Events\LocationCreated',
			'App\Listeners\LocationEventSubscriber@onLocationCreation'
		);
		$events->listen(
			'App\Events\LocationForkCreated',
			'App\Listeners\LocationEventSubscriber@onLocationFork'
		);
		$events->listen(
			'App\Events\LocationCommentCreated',
			'App\Listeners\LocationEventSubscriber@onLocationComment'
		);
		$events->listen(
			'App\Events\LocationLikeCreated',
			'App\Listeners\LocationEventSubscriber@onLocationLike'
		);
	}

}
