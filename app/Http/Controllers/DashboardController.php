<?php

namespace App\Http\Controllers;

use App\User;

class DashboardController extends Controller {
	public function index() {

		$campaigns = \Auth::user()->campaigns->take(5);
		$players = \Auth::user()->players->take(5);

		$follower_count = \Auth::user()->followers->count();
		$following_count = \Auth::user()->following->count();

		$feeds = \App\Feed::where('user_id', \Auth::id())->orderBy('id', 'desc')->take(10)->get();

		return view('dashboard.index', compact('feed_all', 'feed_following', 'feed_user', 'campaigns', 'following_count', 'follower_count', 'feeds', 'players'));
	}

	public function social() {

		$follower_ids = \Auth::user()->following()->pluck('id');
		$feeds = \App\Feed::whereIn('user_id', $follower_ids)->whereNull('private')->latest()->paginate(15);

		return view('dashboard.social', compact('feeds'));
	}

	public function liked() {

		$feeds = \App\Feed::where('user_id', \Auth::id())->whereIn('type', ['monster_like', 'item_like', 'spell_like', 'location_like', 'npc_like'])->latest()->paginate(15);

		return view('dashboard.liked', compact('feeds'));
	}

	public function created() {
		$types = ['monster_created', 'monster_forked', 'item_created', 'item_forked', 'spell_created', 'spell_forked', 'location_created', 'location_forked', 'npc_created', 'npc_forked'];
		$feeds = \App\Feed::where('user_id', \Auth::id())->whereIn('type', $types)->latest()->paginate(15);

		return view('dashboard.created', compact('feeds'));
	}

	public function monsters() {

		$monsters = \Auth::user()->monsters;

		return view('dashboard.index', compact('monsters'));
	}

	public function cleanup() {
		$monsters = \App\Monster::all();
		$npcs = \App\Npc::all();

		foreach ($monsters as $monster) {
			$type = explode(' / ', $monster->type);
			$types = array(trim($type[0]), $monster->subtype1, $monster->subtype2, $monster->subtype3, $monster->subtype4, $monster->subtype5, $monster->subtype6);
			$types = array_map('ucwords', $types);
			$types = implode(' / ', array_filter($types));
			$monster->type = $types;
			$monster->key = isset($monster->key) ? str_random(32) : $monster->key;
			$monster->save();

			if ($monster->spells_at_will) {
				$spells = explode(', ', $monster->spells_at_will);
				foreach ($spells as $spell) {
					$find = \App\Spell::where('name', $spell)->first();
					if ($find) {
						$new = $monster->spells()->attach($find->id, ['level' => 'at_will']);
					}

				}
			}

			if ($monster->spells_one) {
				$spells = explode(', ', $monster->spells_one);
				foreach ($spells as $spell) {
					$find = \App\Spell::where('name', $spell)->first();
					if ($find) {
						$new = $monster->spells()->attach($find->id, ['level' => 'one']);
					}

				}
			}

			if ($monster->spells_two) {
				$spells = explode(', ', $monster->spells_two);
				foreach ($spells as $spell) {
					$find = \App\Spell::where('name', $spell)->first();
					if ($find) {
						$new = $monster->spells()->attach($find->id, ['level' => 'two']);
					}

				}
			}

			if ($monster->spells_three) {
				$spells = explode(', ', $monster->spells_three);
				foreach ($spells as $spell) {
					$find = \App\Spell::where('name', $spell)->first();
					if ($find) {
						$new = $monster->spells()->attach($find->id, ['level' => 'three']);
					}

				}
			}
		}

		foreach ($npcs as $npc) {
			if ($npc->spells_one) {
				$spells = explode(', ', $npc->spells_one);
				foreach ($spells as $spell) {
					$find = \App\Spell::where('name', $spell)->first();
					if ($find) {
						$new = $npc->spells()->attach($find->id, ['level' => 'one']);
					}

				}
			}

			if ($npc->spells_two) {
				$spells = explode(', ', $npc->spells_two);
				foreach ($spells as $spell) {
					$find = \App\Spell::where('name', $spell)->first();
					if ($find) {
						$new = $npc->spells()->attach($find->id, ['level' => 'two']);
					}

				}
			}

			if ($npc->spells_three) {
				$spells = explode(', ', $npc->spells_three);
				foreach ($spells as $spell) {
					$find = \App\Spell::where('name', $spell)->first();
					if ($find) {
						$new = $npc->spells()->attach($find->id, ['level' => 'three']);
					}

				}
			}
		}
	}
}
