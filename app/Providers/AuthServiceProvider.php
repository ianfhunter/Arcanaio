<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		\App\Monster::class => \App\Policies\MonsterPolicy::class,
		\App\Comment::class => \App\Policies\CommentPolicy::class,
		\App\Note::class => \App\Policies\NotePolicy::class,
		\App\Spell::class => \App\Policies\SpellPolicy::class,
		\App\Item::class => \App\Policies\ItemPolicy::class,
		\App\Npc::class => \App\Policies\NpcPolicy::class,
		\App\Location::class => \App\Policies\LocationPolicy::class,
		\App\Campaign::class => \App\Policies\CampaignPolicy::class,
		\App\File::class => \App\Policies\FilePolicy::class,
		\App\Journal::class => \App\Policies\JournalPolicy::class,
		\App\Player::class => \App\Policies\PlayerPolicy::class,
		\App\Combat::class => \App\Policies\CombatPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->registerPolicies();

	}
}
