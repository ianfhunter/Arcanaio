<?php

namespace App\Listeners;

use App\Events\MonsterCreated;
use App\Feed;
use App\Monster;
use App\Notifications\MonsterCommented;
use App\Notifications\MonsterForked;
use App\Notifications\MonsterLiked;
use App\User;

class MonsterEventSubscriber {

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
	 * @param  MonsterCreated  $event
	 * @return void
	 */
	public function onMonsterCreation($event) {

		$data = array('id' => $event->monster->id, 'name' => $event->monster->name, 'user_name' => $event->monster->user->name, 'user_id' => $event->monster->user_id, 'avatar' => $event->monster->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->monster->user_id;
		$feed->type = 'monster_created';
		$feed->data = $data;
		$feed->private = $event->monster->private;
		$feed->save();

	}

	public function onMonsterFork($event) {

		if ($event->monster->user_id != $event->forked->user->id) {
			$user = User::findOrFail($event->forked->user->id);
			$user->notify(new MonsterForked($event->monster, $event->forked, $event->monster->user));
		}

		$data = array('id' => $event->monster->id, 'name' => $event->monster->name, 'user_name' => $event->monster->user->name, 'user_id' => $event->monster->user_id, 'avatar' => $event->monster->user->avatar, 'forked_id' => $event->forked->id, 'forked_name' => $event->forked->name);

		$feed = new Feed;
		$feed->user_id = $event->monster->user_id;
		$feed->type = 'monster_forked';
		$feed->data = $data;
		$feed->private = $event->monster->private;
		$feed->save();

	}

	public function onMonsterComment($event) {
		$monster = Monster::findOrFail($event->comment->commentable_id);

		if ($event->comment->user_id != $monster->user_id) {
			$user = User::findOrFail($monster->user_id);
			$user->notify(new MonsterCommented($monster, $event->comment->user));
		}

		$data = array('id' => $monster->id, 'name' => $monster->name, 'user_name' => $event->comment->user->name, 'user_id' => $event->comment->user_id, 'body' => $event->comment->body, 'avatar' => $event->comment->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->comment->user_id;
		$feed->type = 'monster_comment';
		$feed->data = $data;
		$feed->save();
	}

	public function onMonsterLike($event) {
		$monster = Monster::findOrFail($event->like->likeable_id);

		if ($event->like->user_id != $monster->user_id) {
			$user = User::findOrFail($monster->user_id);
			$user->notify(new MonsterLiked($monster, $event->like->user));
		}

		$data = array('id' => $monster->id, 'name' => $monster->name, 'user_name' => $event->like->user->name, 'user_id' => $event->like->user_id, 'avatar' => $event->like->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->like->user_id;
		$feed->type = 'monster_like';
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
			'App\Events\MonsterCreated',
			'App\Listeners\MonsterEventSubscriber@onMonsterCreation'
		);
		$events->listen(
			'App\Events\MonsterForkCreated',
			'App\Listeners\MonsterEventSubscriber@onMonsterFork'
		);
		$events->listen(
			'App\Events\MonsterCommentCreated',
			'App\Listeners\MonsterEventSubscriber@onMonsterComment'
		);
		$events->listen(
			'App\Events\MonsterLikeCreated',
			'App\Listeners\MonsterEventSubscriber@onMonsterLike'
		);
	}

}
