<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller {
	public function like(Request $request, $type, $id) {
		$type = ucfirst($type);
		$event_name = 'App\Events\\' . $type . 'LikeCreated';

		$existingLike = Like::withTrashed()->where('likeable_type', 'App\\' . $type)->where('likeable_id', $id)->where('user_id', Auth::id())->first();

		if (is_null($existingLike)) {
			$like = Like::create([
				'user_id' => Auth::id(),
				'likeable_id' => $id,
				'likeable_type' => 'App\\' . $type,
			]);

			event(new $event_name($like));

			if ($type != 'Comment' && $type != 'Blog') {
				$like->likeable->increment('like_count');
				$like->likeable()->searchable();
			}

			$response = array(
				'status' => 'liked',
				'msg' => 'Like successful.',
			);

			return response()->json($response);

		} else {
			if (is_null($existingLike->deleted_at)) {
				$existingLike->delete();

				if ($type != 'Comment' && $type != 'Blog') {
					$existingLike->likeable->decrement('like_count');
					$existingLike->likeable()->searchable();
				}

				$response = array(
					'status' => 'unliked',
					'msg' => 'Unlike successful.',
				);
			} else {
				$existingLike->restore();

				if ($type != 'Comment' && $type != 'Blog') {
					$existingLike->likeable->increment('like_count');
					$existingLike->likeable()->searchable();
				}

				$response = array(
					'status' => 'liked',
					'msg' => 'Like successful.',
				);
			}

			return response()->json($response);

		}
	}
}
