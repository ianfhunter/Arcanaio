<?php

namespace App\Http\Controllers;

use App\Events\LocationCreated;
use App\Events\LocationForkCreated;
use App\Http\Requests\StoreLocation;
use App\Http\Requests\UpdateLocation;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

		$location_count = Cache::tags(['locations'])->remember('locations_count', 60, function () {
			return Location::count();
		});

		return view('location.index', compact('locations', 'location_count'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$items = Cache::tags(['items'])->remember('items_list', 60, function () {
			return \App\Item::pluck('name', 'id');
		});

		$monsters = Cache::tags(['monsters'])->remember('monsters_list', 60, function () {
			return \App\Monster::pluck('name', 'id');
		});

		$npcs = Cache::tags(['npcs'])->remember('npcs_list', 60, function () {
			return \App\Npc::pluck('name', 'id');
		});

		$locations = Cache::tags(['locations'])->remember('locations_list', 60, function () {
			return \App\Location::pluck('name', 'id');
		});

		return view('location.create', compact('npcs', 'monsters', 'items', 'locations'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreLocation $request) {
		//
		//  Automatically set some fields that aren't submitted by user.
		$input = $request->except(['_token', 'monsters', 'items', 'npcs', 'owner_tavern']);
		$input['source'] = 'User';
		$input['system'] = '5E';

		//
		//  Start new Location instance and pass it all input.
		$location = new Location($input);

		$location->user_id = \Auth::id();

		if (request('owner_tavern') != NULL) {
			$location->owner = request('owner_tavern');
		} else {
			$location->owner = request('owner');
		}

		$location->key = str_random(32);

		$location->save();

		if (request('items') !== null) {

			foreach (request('items') as $item) {

				$item_found = \App\Item::find($item);

				$location_item = new \App\LocationItem;
				$location_item->location_id = $location->id;
				$location_item->item_id = $item_found->id;
				$location_item->save();
			}

		}

		if (request('npcs') !== null) {

			foreach (request('npcs') as $npc) {

				$npc_found = \App\Npc::find($npc);

				$location_npc = new \App\LocationNpc;
				$location_npc->location_id = $location->id;
				$location_npc->npc_id = $npc_found->id;
				$location_npc->save();
			}

		}

		if (request('monsters') !== null) {

			foreach (request('monsters') as $monster) {

				$monster_found = \App\Monster::find($monster);

				$location_monster = new \App\LocationMonster;
				$location_monster->location_id = $location->id;
				$location_monster->monster_id = $monster_found->id;
				$location_monster->save();
			}

		}

		if ($location->fork_id != null) {
			$forked = Location::find($location->fork_id);
			event(new LocationForkCreated($location, $forked));
		} else {
			event(new LocationCreated($location));
		}

		$request->session()->flash('status', 'Your location has been added!');

		return redirect('location/' . $location->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$location = Cache::remember('locations_' . $id, 60, function () use ($id) {
			return Location::with('comments.user', 'comments.likes', 'likes.user', 'forkedFrom', 'forkedTo', 'private_notes.user', 'user', 'files.user', 'npcs.private_notes', 'monsters.private_notes', 'items.private_notes')->withTrashed()->findOrFail($id);
		});

		if ($location->deleted_at != NULL) {
			return view('deleted');
		}

		if ($location->private == 1) {
			if (Auth::id() != $location->user_id && request()->key != $location->key) {
				return view('private');
			}
		}

		$notes = $location->private_notes->where('user_id', \Auth::id());

		//
		//Log view count
		$key = 'location_' . $location->id . '_' . request()->ip();

		if (Cache::add($key, 'null', 30)) {
			\DB::table('locations')->where('id', $location->id)->increment('view_count', 1);
			Location::find($location->id)->searchable();
		}

		return view('location.show', compact('location', 'notes'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$location = Location::findOrFail($id);

		$this->authorize('update', $location);

		$items = Cache::tags(['items'])->remember('items_list', 60, function () {
			return \App\Item::pluck('name', 'id');
		});

		$monsters = Cache::tags(['monsters'])->remember('monsters_list', 60, function () {
			return \App\Monster::pluck('name', 'id');
		});

		$npcs = Cache::tags(['npcs'])->remember('npcs_list', 60, function () {
			return \App\Npc::pluck('name', 'id');
		});

		$locations = Cache::tags(['locations'])->remember('locations_list', 60, function () {
			return \App\Location::pluck('name', 'id');
		});

		return view('location.edit', compact('location', 'npcs', 'items', 'monsters', 'locations'));
	}

	/**
	 * Show the form for forking the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function fork($id) {
		$location = Location::findOrFail($id);

		$items = Cache::tags(['items'])->remember('items_list', 60, function () {
			return \App\Item::pluck('name', 'id');
		});

		$monsters = Cache::tags(['monsters'])->remember('monsters_list', 60, function () {
			return \App\Monster::pluck('name', 'id');
		});

		$npcs = Cache::tags(['npcs'])->remember('npcs_list', 60, function () {
			return \App\Npc::pluck('name', 'id');
		});

		$locations = Cache::tags(['locations'])->remember('locations_list', 60, function () {
			return \App\Location::pluck('name', 'id');
		});

		return view('location.edit', compact('location', 'npcs', 'items', 'monsters', 'locations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateLocation $request, $id) {
		$location = Location::findOrFail($id);
		$this->authorize('update', $location);

		//
		//  Automatically set some fields that aren't submitted by user.
		$input = $request->except(['_token', 'monsters', 'items', 'npcs', 'owner_tavern']);

		if (request('owner_tavern')) {
			$location->owner = request('owner_tavern');
		} else {
			$location->owner = request('owner');
		}

		if ($location->key == 0) {
			$location->key = str_random(32);
		}

		if (request('parent') == 0) {
			$location->parent = NULL;
		} else {
			$location->parent = request('parent');
		}

		if (request('private') != 1) {
			$location->private = 0;
		}

		//
		//  Save To locations Table
		//
		$location->update($input);

		if (request('items') !== null) {

			\App\LocationItem::where('location_id', $location->id)->delete();

			foreach (request('items') as $item) {

				$item_found = \App\Item::find($item);

				$location_item = new \App\LocationItem;
				$location_item->location_id = $location->id;
				$location_item->item_id = $item_found->id;
				$location_item->save();
			}

		} else {
			\App\LocationItem::where('location_id', $location->id)->delete();
		}

		if (request('npcs') !== null) {

			\App\LocationNpc::where('location_id', $location->id)->delete();

			foreach (request('npcs') as $npc) {

				$npc_found = \App\Npc::find($npc);

				$location_npc = new \App\LocationNpc;
				$location_npc->location_id = $location->id;
				$location_npc->npc_id = $npc_found->id;
				$location_npc->save();
			}

		} else {
			\App\LocationNpc::where('location_id', $location->id)->delete();
		}

		if (request('monsters') !== null) {

			\App\LocationMonster::where('location_id', $location->id)->delete();

			foreach (request('monsters') as $monster) {

				$monster_found = \App\Monster::find($monster);

				$location_monster = new \App\LocationMonster;
				$location_monster->location_id = $location->id;
				$location_monster->monster_id = $monster_found->id;
				$location_monster->save();
			}

		} else {
			\App\LocationMonster::where('location_id', $location->id)->delete();
		}

		$request->session()->flash('status', 'Your location has been edited!');

		return redirect()->action('LocationController@show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		$location = Location::findOrFail($id);
		$this->authorize('delete', $location);

		$location->delete();

		// redirect
		$request->session()->flash('status', 'Successfully deleted the location!');
		return redirect('location');
	}

}
