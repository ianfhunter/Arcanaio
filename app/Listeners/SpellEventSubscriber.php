<?php

namespace App\Listeners;

use App\Events\SpellCreated;
use App\Feed;
use App\Notifications\SpellCommented;
use App\Notifications\SpellForked;
use App\Notifications\SpellLiked;
use App\Spell;
use App\User;

class SpellEventSubscriber {

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
	 * @param  SpellCreated  $event
	 * @return void
	 */
	public function onSpellCreation($event) {

		$data = array('id' => $event->spell->id, 'name' => $event->spell->name, 'user_name' => $event->spell->user->name, 'user_id' => $event->spell->user_id, 'avatar' => $event->spell->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->spell->user_id;
		$feed->type = 'spell_created';
		$feed->data = $data;
		$feed->private = $event->spell->private;
		$feed->save();

	}

	public function onSpellFork($event) {

		if ($event->spell->user_id != $event->forked->user->id) {
			$user = User::findOrFail($event->forked->user->id);
			$user->notify(new SpellForked($event->spell, $event->forked, $event->spell->user));
		}

		$data = array('id' => $event->spell->id, 'name' => $event->spell->name, 'user_name' => $event->spell->user->name, 'user_id' => $event->spell->user_id, 'avatar' => $event->spell->user->avatar, 'forked_id' => $event->forked->id, 'forked_name' => $event->forked->name);

		$feed = new Feed;
		$feed->user_id = $event->spell->user_id;
		$feed->type = 'spell_forked';
		$feed->data = $data;
		$feed->private = $event->spell->private;
		$feed->save();

	}

	public function onSpellComment($event) {
		$spell = Spell::findOrFail($event->comment->commentable_id);

		if ($event->comment->user_id != $spell->user_id) {
			$user = User::findOrFail($spell->user_id);
			$user->notify(new SpellCommented($spell, $event->comment->user));
		}

		$data = array('id' => $spell->id, 'name' => $spell->name, 'user_name' => $event->comment->user->name, 'user_id' => $event->comment->user_id, 'body' => $event->comment->body, 'avatar' => $event->comment->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->comment->user_id;
		$feed->type = 'spell_comment';
		$feed->data = $data;
		$feed->save();
	}

	public function onSpellLike($event) {
		$spell = Spell::findOrFail($event->like->likeable_id);

		if ($event->like->user_id != $spell->user_id) {
			$user = User::findOrFail($spell->user_id);
			$user->notify(new SpellLiked($spell, $event->like->user));
		}

		$data = array('id' => $spell->id, 'name' => $spell->name, 'user_name' => $event->like->user->name, 'user_id' => $event->like->user_id, 'avatar' => $event->like->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->like->user_id;
		$feed->type = 'spell_like';
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
			'App\Events\SpellCreated',
			'App\Listeners\SpellEventSubscriber@onSpellCreation'
		);
		$events->listen(
			'App\Events\SpellForkCreated',
			'App\Listeners\SpellEventSubscriber@onSpellFork'
		);
		$events->listen(
			'App\Events\SpellCommentCreated',
			'App\Listeners\SpellEventSubscriber@onSpellComment'
		);
		$events->listen(
			'App\Events\SpellLikeCreated',
			'App\Listeners\SpellEventSubscriber@onSpellLike'
		);
	}

}
