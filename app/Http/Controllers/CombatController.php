<?php

namespace App\Http\Controllers;

use App\Combat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CombatController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

		$monsters = Cache::tags(['monsters'])->remember('monsters_list_combat', 60, function () {
			return \App\Monster::all('id', 'name', 'AC', 'dexterity', 'HP');
		});

		$npcs = Cache::tags(['npcs'])->remember('npcs_list_combat', 60, function () {
			return \App\Npc::all('id', 'name', 'AC', 'dexterity', 'HP');
		});

		$players = [];

		$combat_list = null;

		if (Auth::user()) {
			if (Auth::user()->campaigns) {
				foreach (Auth::user()->campaigns as $campaign) {
					foreach ($campaign->players as $player) {
						$players[] = ['id' => $player->id, 'name' => $player->name, 'AC' => $player->AC, 'HP' => $player->HP_max, 'dexterity' => $player->dexterity];
					}
				}
			}

			if (Auth::user()->players) {
				foreach (Auth::user()->players as $player) {
					$players[] = ['id' => $player->id, 'name' => $player->name, 'AC' => $player->AC, 'HP' => $player->HP_max, 'dexterity' => $player->dexterity];
				}
			}

			$combat_list = Auth::user()->combats->sortByDesc('created_at');
		}

		$players = array_unique($players, SORT_REGULAR);

		$data = null;

		return view('combat.index', compact('monsters', 'npcs', 'players', 'combat_list', 'data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|string|max:140',
		]);

		$combat = new Combat();

		$combat->user_id = \Auth::id();
		$combat->name = $request->input('name');
		$combat->data = $request->input('data');

		$combat->save();

		$request->session()->flash('status', 'Your encounter has been saved!');

		return redirect('combat/' . $combat->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$combat = Combat::findOrFail($id);

		$this->authorize('view', $combat);

		$data = json_decode($combat->data);

		$monsters = Cache::tags(['monsters'])->remember('monsters_list_combat', 60, function () {
			return \App\Monster::all('id', 'name', 'AC', 'dexterity', 'HP');
		});

		$npcs = Cache::tags(['npcs'])->remember('npcs_list_combat', 60, function () {
			return \App\Npc::all('id', 'name', 'AC', 'dexterity', 'HP');
		});

		$players = [];

		if (Auth::user()) {
			if (Auth::user()->campaigns) {
				foreach (Auth::user()->campaigns as $campaign) {
					foreach ($campaign->players as $player) {
						$players[] = ['id' => $player->id, 'name' => $player->name, 'AC' => $player->AC, 'HP' => $player->HP_max, 'dexterity' => $player->dexterity];
					}
				}
			}

			if (Auth::user()->players) {
				foreach (Auth::user()->players as $player) {
					$players[] = ['id' => $player->id, 'name' => $player->name, 'AC' => $player->AC, 'HP' => $player->HP_max, 'dexterity' => $player->dexterity];
				}
			}

			$combat_list = Auth::user()->combats->sortByDesc('created_at');
		}

		$players = array_unique($players, SORT_REGULAR);

		return view('combat.index', compact('data', 'monsters', 'npcs', 'players', 'combat_list', 'combat'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required|string|max:140',
		]);

		$combat = Combat::findOrFail($id);
		$this->authorize('update', $combat);

		$combat->name = $request->input('name');
		$combat->data = $request->input('data');

		$combat->save();

		$request->session()->flash('status', 'Your encounter has been saved!');

		return redirect('combat/' . $combat->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		$combat = Combat::findOrFail($id);
		$this->authorize('delete', $combat);

		$combat->delete();

		// redirect
		$request->session()->flash('status', 'Successfully deleted the combat!');
		return redirect('combat');
	}

}
