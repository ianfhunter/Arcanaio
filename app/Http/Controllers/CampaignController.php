<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests\StoreCampaign;
use App\Http\Requests\UpdateCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CampaignController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$campaigns = \Auth::user()->campaigns;

		return view('campaign.index', compact('campaigns'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('campaign.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCampaign $request) {
		$campaign = new Campaign();
		$campaign->name = $request->input('name');
		$campaign->user_id = \Auth::id();
		$campaign->save();

		$request->session()->flash('status', 'Your campaign has been added!');

		return redirect('campaign/' . $campaign->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$campaign = Campaign::findOrFail($id);
		$this->authorize('view', $campaign);

		return view('campaign.show', compact('campaign'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function view($id, $type) {
		$campaign = Campaign::findOrFail($id);

		$this->authorize('view', $campaign);

		if ($type == 'monsters') {
			$campaign->load(['monsters.locations' => function ($query) {
				$query->where('user_id', '=', \Auth::id());
			}]);
			$monsters = Cache::tags(['monsters'])->remember('monsters_list', 60, function () {
				return \App\Monster::pluck('name', 'id');
			});
		} elseif ($type == 'npcs') {
			$campaign->load(['npcs.locations' => function ($query) {
				$query->where('user_id', '=', \Auth::id());
			}]);
			$npcs = Cache::tags(['npcs'])->remember('npcs_list', 60, function () {
				return \App\Npc::pluck('name', 'id');
			});
		} elseif ($type == 'items') {
			$campaign->load(['items.locations' => function ($query) {
				$query->where('user_id', '=', \Auth::id());
			}]);
			$items = Cache::tags(['items'])->remember('items_list', 60, function () {
				return \App\Item::pluck('name', 'id');
			});
		} elseif ($type == 'locations') {
			$locations = Cache::tags(['locations'])->remember('locations_list', 60, function () {
				return \App\Location::pluck('name', 'id');
			});
		}

		return view('campaign.' . $type, compact('campaign', 'monsters', 'items', 'npcs', 'locations'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$campaign = Campaign::findOrFail($id);

		$this->authorize('update', $campaign);

		return view('campaign.edit', compact('campaign'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateCampaign $request, $id) {
		$campaign = Campaign::findOrFail($id);

		$this->authorize('update', $campaign);

		$campaign->name = $request->input('name');

		$campaign->update();

		$request->session()->flash('status', 'Your campaign has been edited!');

		return redirect()->action('CampaignController@show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		$campaign = Campaign::findOrFail($id);

		$this->authorize('delete', $campaign);

		$campaign->delete();

		// redirect
		$request->session()->flash('status', 'Successfully deleted the campaign!');

		return redirect('campaign');
	}

	public function add(Request $request, $type, $id) {
		$this->validate($request, [
			'campaign' => 'required|numeric',
		]);

		$campaign = Campaign::findOrFail($request->input('campaign'));
		$this->authorize('update', $campaign);

		$relationship = $type . "s";

		$campaign->$relationship()->syncWithoutDetaching([$id]);

		$request->session()->flash('status', 'Successfully added to your campaign!');

		return back();
	}

	public function batch(Request $request, $type) {
		$this->validate($request, [
			'campaign' => 'required|numeric',
			'monsters' => 'array',
			'items' => 'array',
			'locations' => 'array',
			'npcs' => 'array',
		]);

		$campaign = Campaign::findOrFail($request->input('campaign'));
		$this->authorize('update', $campaign);

		if ($request->input('monsters') !== null) {
			foreach ($request->input('monsters') as $monster) {
				$campaign->$type()->syncWithoutDetaching([$monster]);
			}
		} elseif ($request->input('items') !== null) {
			foreach ($request->input('items') as $item) {
				$campaign->$type()->syncWithoutDetaching([$item]);
			}
		} elseif ($request->input('npcs') !== null) {
			foreach ($request->input('npcs') as $npc) {
				$campaign->$type()->syncWithoutDetaching([$npc]);
			}
		} elseif ($request->input('locations') !== null) {
			foreach ($request->input('locations') as $location) {
				$campaign->$type()->syncWithoutDetaching([$location]);
			}
		}

		$request->session()->flash('status', 'Successfully added to your campaign!');

		return back();
	}

	public function detach(Request $request, $type, $object) {
		$this->validate($request, [
			'campaign' => 'required|numeric',
		]);

		$campaign = Campaign::findOrFail($request->input('campaign'));

		$this->authorize('update', $campaign);

		$campaign->$type()->detach($object);

		$request->session()->flash('status', 'Successfully removed from your campaign!');

		return back();
	}
}
