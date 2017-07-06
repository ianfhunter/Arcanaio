<?php

namespace App\Http\Controllers;

use App\Events\ItemCreated;
use App\Events\ItemForkCreated;
use App\Http\Requests\StoreItem;
use App\Http\Requests\UpdateItem;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

		$item_count = Cache::tags(['items'])->remember('items_count', 60, function () {
			return Item::count();
		});

		return view('item.index', compact('items', 'item_count'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('item.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreItem $request) {

		$input = $request->except(['_token', 'weapon_damage', 'weapon_damage_type', 'weapon_subtype', 'armor_subtype']);
		$input['source'] = 'User';
		$input['system'] = '5E';

		//
		// Was too lazy to split the source material into separate columns, so must concat the two fields
		//
		if ($request->input('weapon_damage')) {
			$weapon_damage = $request->input('weapon_damage') . ' ' . $request->input('weapon_damage_type');
		} else {
			$weapon_damage = null;
		}

		//
		// Check which subtype input to set to the subtype field.
		//
		$subtype = $request->input('weapon_subtype') ? $request->input('weapon_subtype') : $request->input('armor_subtype');

		// Create item.
		$item = new Item($input);
		$item->user_id = \Auth::id();
		$item->weapon_damage = $weapon_damage;
		$item->subtype = $subtype;
		$item->key = str_random(32);
		$item->save();

		//
		// Trigger events that send notifications. If it has been forked, find the source object and pass
		// that info to event.
		//
		if ($item->fork_id != null) {
			$forked = Item::find($item->fork_id);
			event(new ItemForkCreated($item, $forked));
		} else {
			event(new ItemCreated($item));
		}

		$request->session()->flash('status', 'Your item has been added!');

		return redirect()->route('item.show', $item->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

		$item = Cache::remember('items_' . $id, 60, function () use ($id) {
			return Item::with('comments.user', 'comments.likes', 'likes.user', 'forkedFrom', 'forkedTo', 'private_notes.user', 'user', 'files.user')->withTrashed()->findOrFail($id);
		});

		if ($item->private == 1) {
			if (Auth::id() != $item->user_id && request()->key != $item->key) {
				return view('private');
			}
		}

		if ($item->deleted_at != NULL) {
			return view('deleted');
		}

		$notes = $item->private_notes->where('user_id', \Auth::id());

		//Log view count
		$key = 'item_' . $item->id . '_' . request()->ip();

		if (Cache::add($key, 'null', 30)) {
			\DB::table('items')->where('id', $item->id)->increment('view_count', 1);
			Item::find($item->id)->searchable();
		}

		return view('item.show', compact('item', 'notes'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$item = Item::findOrFail($id);

		$this->authorize('update', $item);

		if ($item->type == 'Weapon') {
			$weapon_damage = explode(' ', $item->weapon_damage);
			$item->weapon_damage = $weapon_damage[0];
			$item->weapon_damage_type = $weapon_damage[1];
			$item->weapon_subtype = $item->subtype;
		} elseif ($item->type == 'Armor') {
			$item->armor_subtype = $item->subtype;
		}

		return view('item.edit', compact('item'));
	}

	public function fork($id) {
		$item = Item::findOrFail($id);

		if ($item->type == 'Weapon') {
			$weapon_damage = explode(' ', $item->weapon_damage);
			$item->weapon_damage = $weapon_damage[0];
			$item->weapon_damage_type = $weapon_damage[1];
			$item->weapon_subtype = $item->subtype;
		} elseif ($item->type == 'Armor') {
			$item->armor_subtype = $item->subtype;
		}

		return view('item.edit', compact('item'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateItem $request, $id) {

		$item = Item::findOrFail($id);

		$this->authorize('update', $item);

		$input = $request->except(['_token', 'weapon_damage', 'weapon_damage_type', 'weapon_subtype', 'armor_subtype']);

		if ($request->input('weapon_damage')) {
			$item->weapon_damage = $request->input('weapon_damage') . ' ' . $request->input('weapon_damage_type');
		} else {
			$item->weapon_damage = null;
		}

		//
		// Check which subtype input to set to the subtype field.
		//
		$item->subtype = $request->input('weapon_subtype') ? $request->input('weapon_subtype') : $request->input('armor_subtype');

		if ($item->key == 0) {
			$item->key = str_random(32);
		}

		$request->input('private') ? $item->private = 1 : $item->private = 0;

		if ($item->private == 0) {
			$item->key = str_random(32);
		}

		//
		//  Save To Spells Table
		//
		$item->update($input);

		$request->session()->flash('status', 'Your item has been edited!');

		return redirect()->action('ItemController@show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		$item = Item::findOrFail($id);

		$this->authorize('delete', $item);

		$item->delete();

		$request->session()->flash('status', 'Successfully deleted the item!');

		return redirect('item');
	}

}
