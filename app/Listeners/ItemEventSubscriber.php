<?php

namespace App\Listeners;

use App\Events\ItemCreated;
use App\Feed;
use App\Item;
use App\Notifications\ItemCommented;
use App\Notifications\ItemForked;
use App\Notifications\ItemLiked;
use App\User;

class ItemEventSubscriber {

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
	public function onItemCreation($event) {

		$data = array('id' => $event->item->id, 'name' => $event->item->name, 'user_name' => $event->item->user->name, 'user_id' => $event->item->user_id, 'avatar' => $event->item->user->avatar);

		$feed = new Feed;
		$feed->user_id = $event->item->user_id;
		$feed->type = 'item_created';
		$feed->data = $data;
		$feed->private = $event->item->private;
		$feed->save();

	}

	public function onItemFork($event) {

		if ($event->item->user_id != $event->forked->user->id) {
			$user = User::findOrFail($event->forked->user->id);
			$user->notify(new ItemForked($event->item, $event->forked, $event->item->user));
		}

		$data = array('id' => $event->item->id, 'name' => $event->item->name, 'user_name' => $event->item->user->name, 'user_id' => $event->item->user_id, 'avatar' => $event->item->user->avatar, 'forked_id' => $event->forked->id, 'forked_name' => $event->forked->name);

		$feed = new Feed;
		$feed->user_id = $event->item->user_id;
		$feed->type = 'item_forked';
		$feed->data = $data;
		$feed->private = $event->item->private;
		$feed->save();

	}

	public function onItemComment($event) {
		$item = Item::findOrFail($event->comment->commentable_id);

		if ($event->comment->user_id != $item->user_id) {
			$user = User::findOrFail($item->user_id);
			$user->notify(new ItemCommented($item, $event->comment->user));
		}

		$data = array('id' => $item->id, 'name' => $item->name, 'user_name' => $event->comment->user->name, 'user_id' => $event->comment->user_id, 'body' => $event->comment->body);

		$feed = new Feed;
		$feed->user_id = $event->comment->user_id;
		$feed->type = 'item_comment';
		$feed->data = $data;
		$feed->save();
	}

	public function onItemLike($event) {
		$item = Item::findOrFail($event->like->likeable_id);

		if ($event->like->user_id != $item->user_id) {
			$user = User::findOrFail($item->user_id);
			$user->notify(new ItemLiked($item, $event->like->user));
		}

		$data = array('id' => $item->id, 'name' => $item->name, 'user_name' => $event->like->user->name, 'user_id' => $event->like->user_id);

		$feed = new Feed;
		$feed->user_id = $event->like->user_id;
		$feed->type = 'item_like';
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
			'App\Events\ItemCreated',
			'App\Listeners\ItemEventSubscriber@onItemCreation'
		);
		$events->listen(
			'App\Events\ItemForkCreated',
			'App\Listeners\ItemEventSubscriber@onItemFork'
		);
		$events->listen(
			'App\Events\ItemCommentCreated',
			'App\Listeners\ItemEventSubscriber@onItemComment'
		);
		$events->listen(
			'App\Events\ItemLikeCreated',
			'App\Listeners\ItemEventSubscriber@onItemLike'
		);
	}

}
