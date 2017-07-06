<?php

namespace App\Listeners;

use App\Events\NpcCreated;
use App\Feed;
use App\Notifications\NpcCommented;
use App\Notifications\NpcForked;
use App\Notifications\NpcLiked;
use App\Npc;
use App\User;

class NpcEventSubscriber {

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
	 * @param  npcCreated  $event
	 * @return void
	 */
	public function onNpcCreation($event) {

		$data = array('id' => $event->npc->id, 'name' => $event->npc->name, 'user_name' => $event->npc->user->name, 'user_id' => $event->npc->user_id, 'avatar' => $event->npc->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->npc->user_id;
		$feed->type = 'npc_created';
		$feed->data = $data;
		$feed->private = $event->npc->private;
		$feed->save();

	}

	public function onNpcFork($event) {

		if ($event->npc->user_id != $event->forked->user->id) {
			$user = User::findOrFail($event->forked->user->id);
			$user->notify(new NpcForked($event->npc, $event->forked, $event->npc->user));
		}

		$data = array('id' => $event->npc->id, 'name' => $event->npc->name, 'user_name' => $event->npc->user->name, 'user_id' => $event->npc->user_id, 'avatar' => $event->npc->user->avatar, 'forked_id' => $event->forked->id, 'forked_name' => $event->forked->name);

		$feed = new Feed;
		$feed->user_id = $event->npc->user_id;
		$feed->type = 'npc_forked';
		$feed->data = $data;
		$feed->private = $event->npc->private;
		$feed->save();

	}

	public function onNpcComment($event) {
		$npc = Npc::findOrFail($event->comment->commentable_id);

		if ($event->comment->user_id != $npc->user_id) {
			$user = User::findOrFail($npc->user_id);
			$user->notify(new NpcCommented($npc, $event->comment->user));
		}

		$data = array('id' => $npc->id, 'name' => $npc->name, 'user_name' => $event->comment->user->name, 'user_id' => $event->comment->user_id, 'body' => $event->comment->body, 'avatar' => $event->comment->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->comment->user_id;
		$feed->type = 'npc_comment';
		$feed->data = $data;
		$feed->save();
	}

	public function onnpcLike($event) {
		$npc = Npc::findOrFail($event->like->likeable_id);

		if ($event->like->user_id != $npc->user_id) {
			$user = User::findOrFail($npc->user_id);
			$user->notify(new NpcLiked($npc, $event->like->user));
		}

		$data = array('id' => $npc->id, 'name' => $npc->name, 'user_name' => $event->like->user->name, 'user_id' => $event->like->user_id, 'avatar' => $event->like->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->like->user_id;
		$feed->type = 'npc_like';
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
			'App\Events\NpcCreated',
			'App\Listeners\NpcEventSubscriber@onNpcCreation'
		);
		$events->listen(
			'App\Events\NpcForkCreated',
			'App\Listeners\NpcEventSubscriber@onNpcFork'
		);
		$events->listen(
			'App\Events\NpcCommentCreated',
			'App\Listeners\NpcEventSubscriber@onNpcComment'
		);
		$events->listen(
			'App\Events\NpcLikeCreated',
			'App\Listeners\NpcEventSubscriber@onNpcLike'
		);
	}

}
