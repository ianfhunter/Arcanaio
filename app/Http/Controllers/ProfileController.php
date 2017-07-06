<?php

namespace App\Http\Controllers;

use App\Feed;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($id = null) {

		if (!isset($id)) {
			$user = Auth::user();
		} else {
			$user = User::withTrashed()->findOrFail($id);
		}

		if ($user->deleted_at != null) {
			return view('deleted');
		}

		$follower_count = $user->followers->count();
		$following_count = $user->following->count();

		$feeds = Feed::where('user_id', $user->id)->whereNull('private')->orderBy('id', 'desc')->get();

		return view('profile.index', compact('user', 'feeds', 'follower_count', 'following_count'));
	}

	public function follow($id) {

		$user = User::findOrFail($id);
		Auth::user()->following()->save($user);

		$data = array('follower_id' => Auth::id(), 'follower_name' => Auth::user()->name, 'followed_name' => $user->name, 'followed_id' => $user->id, 'follower_avatar' => Auth::user()->avatar, 'followed_avatar' => $user->avatar);

		$feed = new Feed;
		$feed->user_id = Auth::id();
		$feed->type = 'user_followed';
		$feed->data = $data;
		$feed->save();

		return back();

	}

	public function unfollow($id) {

		$user = User::findOrFail($id);
		Auth::user()->following()->detach($user);

		return back();

	}
}
