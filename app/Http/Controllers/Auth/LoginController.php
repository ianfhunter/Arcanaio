<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	 */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/dashboard';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest', ['except' => 'logout']);
	}

	public function getSocialAuth($provider = null) {
		if (!config("services.$provider")) {
			abort('404');
		}
		//just to handle providers that doesn't exist

		return Socialite::driver($provider)->redirect();
	}

	public function getSocialAuthCallback($provider = null) {
		if ($user = Socialite::with($provider)->user()) {

			$authUser = $this->findOrCreateUser($user);

			if ($authUser->name != null) {

				\Auth::login($authUser, true);

				return redirect()->intended('dashboard');
			} else {
				return redirect('auth/setup/' . $authUser->id . '/' . $provider);
			}

		} else {
			return 'Oops, something went wrong. Try again.';
		}
	}

	private function findOrCreateUser($socialUser) {
		if ($authUser = User::where('social_id', $socialUser->id)->first()) {
			return $authUser;
		} elseif ($authUser = User::where('email', $socialUser->email)->first()) {

			$authUser->social_id = $socialUser->id;
			$authUser->save();

			return $authUser;
		}

		return User::create([
			'name' => null,
			'email' => $socialUser->email,
			'password' => bcrypt(str_random(40)),
			'social_id' => $socialUser->id,
			'avatar' => $socialUser->avatar,
		]);
	}
}
