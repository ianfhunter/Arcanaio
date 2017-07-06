<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		\App\Monster::observe(\App\Observers\MonsterObserver::class);
		\App\Like::observe(\App\Observers\LikeObserver::class);
		\App\Spell::observe(\App\Observers\SpellObserver::class);
		\App\Comment::observe(\App\Observers\CommentObserver::class);
		\App\Item::observe(\App\Observers\ItemObserver::class);
		\App\Npc::observe(\App\Observers\NpcObserver::class);
		\App\Location::observe(\App\Observers\LocationObserver::class);
		\App\Player::observe(\App\Observers\PlayerObserver::class);
		\App\Note::observe(\App\Observers\NoteObserver::class);
		\App\File::observe(\App\Observers\FileObserver::class);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
