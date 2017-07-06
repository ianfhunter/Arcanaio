<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [

	];

	protected $subscribe = [
		'App\Listeners\MonsterEventSubscriber',
		'App\Listeners\SpellEventSubscriber',
		'App\Listeners\ItemEventSubscriber',
		'App\Listeners\NpcEventSubscriber',
		'App\Listeners\CommentEventSubscriber',
		'App\Listeners\LocationEventSubscriber',
		'App\Listeners\BlogEventSubscriber',
	];
	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot() {
		parent::boot();

		//
	}
}
