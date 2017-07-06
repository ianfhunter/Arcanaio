<?php
//
//TODO: Add delete account option
///
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Image;

class SettingsController extends Controller
{
	public function postSettings(Request $request)
	{
		if($request->user()){

			$user = Auth::user();

			$this->validate($request, [
		        'location' => 'max:140',
		        'website' => 'max:140',
		        'bio' => 'max:200',
		        'newsletter' => 'boolean',
		        'avatar' => 'image|max:5000',
		    ]);		    

			$user->location = request('location');
			$user->website = request('website');
			$user->bio = request('bio');
			//$user->avatar = request('avatar');
			$user->newsletter = request('newsletter');

			if($request->hasFile('avatar')){
				$ext = $request->file('avatar')->guessExtension();

				$img = Image::make($request->file('avatar'))->fit(200);
				\Storage::cloud()->put('avatars/'.$user->id.'.'.$ext, $img->stream()->__toString(), 'public');

				$user->avatar = \Storage::cloud()->url('avatars/'.$user->id.'.'.$ext);
			}

			$user->save();

			$request->session()->flash('status', 'Changes were saved!');

			return view('settings');
		}
	}

	public function delete(Request $request)
	{
		if($request->user()){

			$user = Auth::user();

			$this->validate($request, [
		        'user_id' => 'numeric',
		    ]);		    

			if(Auth::id() == request('user_id')){
				$user->email = str_random(32);
				$user->password = str_random(32);
				$user->avatar = '/img/avatar.jpg';
				$user->location = NULL;
				$user->website = NULL;
				$user->bio = NULL;
				$user->social_id = NULL;
				$user->newsletter = 0;
				$user->remember_token = NULL;
				$user->deleted_at = \Carbon\Carbon::now();
				$user->role = NULL;

				$user->save();

				Auth::logout();

				return redirect('/');
			}else{
				$request->session()->flash('status', 'Failed to delete account. Try again or email feedback@arcana.io.');

				return view('settings');
			}
		}
	}
}
