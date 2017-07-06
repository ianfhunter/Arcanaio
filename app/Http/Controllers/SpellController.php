<?php

namespace App\Http\Controllers;

use App\Events\SpellCreated;
use App\Events\SpellForkCreated;
use App\Http\Requests\StoreSpell;
use App\Http\Requests\UpdateSpell;
use App\Spell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SpellController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

		$spell_count = Cache::tags(['spells'])->remember('spells_count', 60, function () {
			return Spell::count();
		});

		return view('spell.index', compact('spells', 'spell_count'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('spell.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreSpell $request) {
		//
		//  Automatically set some fields that aren't submitted by user.
		//

		$input = $request->except(['_token', 'components', 'class']);
		$input['source'] = 'User';
		$input['system'] = '5E';

		//
		//  Format the components and classes correctly.
		//
		$components = implode(', ', request('components'));
		$classes = implode(', ', request('class'));

		//
		//  Start new Spell instance and pass it all input.
		//
		$spell = new Spell($input);

		$spell->user_id = \Auth::id();
		$spell->components = $components;
		$spell->class = $classes;

		$spell->key = str_random(32);
		//
		//  Save To Spells Table
		//
		$spell->save();

		if ($spell->fork_id != null) {
			$forked = Spell::find($spell->fork_id);
			event(new SpellForkCreated($spell, $forked));
		} else {
			event(new SpellCreated($spell));
		}

		$request->session()->flash('status', 'Your spell has been added!');

		return redirect()->route('spell.show', $spell->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$spell = Cache::remember('spells_' . $id, 60, function () use ($id) {
			return Spell::with('comments.user', 'comments.likes', 'likes.user', 'forkedFrom', 'forkedTo', 'private_notes.user', 'user', 'files.user')->withTrashed()->findOrFail($id);
		});

		if ($spell->deleted_at != NULL) {
			return view('deleted');
		}

		if ($spell->private == 1) {
			if (Auth::id() != $spell->user_id && request()->key != $spell->key) {
				return view('private');
			}
		}

		$notes = $spell->private_notes->where('user_id', \Auth::id());

		//
		//Log view count
		//
		$key = 'spell_' . $spell->id . '_' . request()->ip();

		if (Cache::add($key, 'null', 30)) {
			\DB::table('spells')->where('id', $spell->id)->increment('view_count', 1);
			Spell::find($spell->id)->searchable();
		}

		return view('spell.show', compact('spell', 'notes'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$spell = Spell::findOrFail($id);

		$this->authorize('update', $spell);

		$spell->class = array_map('trim', explode(',', $spell->class));
		$spell->components = array_map('trim', explode(',', $spell->components));

		return view('spell.edit', compact('spell'));
	}

	/**
	 * Show the form for forking the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function fork($id) {
		$spell = Spell::findOrFail($id);

		$spell->class = array_map('trim', explode(',', $spell->class));
		$spell->components = array_map('trim', explode(',', $spell->components));

		return view('spell.edit', compact('spell'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateSpell $request, $id) {
		$spell = Spell::findOrFail($id);
		$this->authorize('update', $spell);

		//
		//  Automatically set some fields that aren't submitted by user.
		//
		$input = $request->except(['_token', 'components', 'class']);

		//
		//  Format the components and classes correctly.
		//
		$components = implode(', ', request('components'));
		$classes = implode(', ', request('class'));

		//
		//  Start new Spell instance and pass it all input.
		//
		$spell->components = $components;
		$spell->class = $classes;

		$spell->concentration = request('concentration') ? 1 : 0;
		$spell->ritual = request('ritual') ? 1 : 0;
		$spell->private = request('private') ? 1 : 0;

		if ($spell->key == 0) {
			$spell->key = str_random(32);
		}

		//
		//  Save To Spells Table
		//
		$spell->update($input);

		$request->session()->flash('status', 'Your spell has been edited!');

		return redirect()->action('SpellController@show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id) {
		$spell = Spell::findOrFail($id);
		$this->authorize('delete', $spell);

		$spell->delete();

		// redirect
		$request->session()->flash('status', 'Successfully deleted the spell!');
		return redirect('spell');
	}

}
