<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::group(['middleware' => 'auth'], function () {

	//
	// Profile Routes
	//

	Route::get('settings', function () {
		return view('settings');
	});

	Route::post('settings', ['uses' => 'SettingsController@postSettings']);
	Route::post('settings/delete', ['uses' => 'SettingsController@delete']);

	Route::post('upload/{type}/{id}', ['uses' => 'FileController@upload']);
	Route::delete('file/delete/{id}', ['uses' => 'FileController@delete']);

	Route::get('dashboard', 'DashboardController@index');
	Route::get('social', 'DashboardController@social');
	Route::get('liked', 'DashboardController@liked');
	Route::get('created', 'DashboardController@created');
	Route::get('dashboard/monsters', 'DashboardController@monsters');

	Route::get('profile/{id?}', 'ProfileController@index');

	Route::post('profile/follow/{id}', 'ProfileController@follow');
	Route::post('profile/unfollow/{id}', 'ProfileController@unfollow');

	//
	// Map Routes
	//
	Route::resource('map', 'MapController');

	//
	//Campaign Routes
	//

	Route::resource('campaign', 'CampaignController');
	Route::post('campaign/add/{type}/{id}', 'CampaignController@add');
	Route::post('campaign/batch/{type}', 'CampaignController@batch');
	Route::post('campaign/remove/{type}/{object}', 'CampaignController@detach');
	Route::get('campaign/{id}/{type}', 'CampaignController@view');

	//
	//Player Routes
	//

	Route::resource('character', 'PlayerController');
	Route::resource('player', 'PlayerController');
	Route::get('character/{id}/{key}', ['as' => 'character.private', 'uses' => 'PlayerController@show']);
	Route::post('character/batch/items', 'PlayerController@batchItems');
	Route::post('character/batch/spells', 'PlayerController@batchSpells');
	Route::post('character/prepare/{character}/{spell}', 'PlayerController@prepareSpell');
	Route::get('character/forget/{character}/{spell}', 'PlayerController@forgetSpell');
	Route::post('character/cast/{character}/{slot}', 'PlayerController@incrementSpellCasts');
	Route::post('character/uncast/{character}/{slot}', 'PlayerController@decrementSpellCasts');
	Route::post('character/increment/{character}/{item}', 'PlayerController@incrementItemQuantity');
	Route::post('character/decrement/{character}/{item}', 'PlayerController@decrementItemQuantity');
	Route::post('character/coins/{character}', 'PlayerController@coins');
	Route::post('character/damage/{character}', 'PlayerController@damage');
	Route::post('character/heal/{character}', 'PlayerController@heal');
	Route::post('character/longrest/{character}', 'PlayerController@longRest');

	//
	// Initiative Routes
	//
	Route::resource('combat', 'CombatController');

	//
	// Item Routes
	//

	Route::resource('item', 'ItemController', ['except' => [
		'index', 'show',
	]]);

	Route::post('item/like/{id}', ['as' => 'item.like', 'uses' => 'ItemController@like']);

	Route::get('item/fork/{id}', ['as' => 'item.fork', 'uses' => 'ItemController@fork']);

	//
	// Item Routes
	//

	Route::resource('location', 'LocationController', ['except' => [
		'index', 'show',
	]]);

	Route::post('location/like/{id}', ['as' => 'location.like', 'uses' => 'LocationController@like']);

	Route::get('location/fork/{id}', ['as' => 'location.fork', 'uses' => 'LocationController@fork']);

	//
	// Encounter Routes
	//

	Route::resource('encounter', 'EncounterController', ['except' => [
		'index', 'show',
	]]);

	Route::post('encounter/like/{id}', ['as' => 'encounter.like', 'uses' => 'EncounterController@like']);

	Route::get('encounter/fork/{id}', ['as' => 'encounter.fork', 'uses' => 'EncounterController@fork']);

	//
	// NPC Routes
	//

	Route::resource('npc', 'NpcController', ['except' => [
		'index', 'show',
	]]);

	Route::post('npc/like/{id}', ['as' => 'Npc.like', 'uses' => 'NpcController@like']);

	Route::get('npc/fork/{id}', ['as' => 'Npc.fork', 'uses' => 'NpcController@fork']);

	//
	// Spell Routes
	//
	Route::get('spell/list', ['as' => 'spell.list', 'uses' => 'SpellController@list']);

	Route::resource('spell', 'SpellController');

	Route::get('spell/sort/{type}', ['as' => 'spell.sort', 'uses' => 'SpellController@sort']);
	Route::get('spell/class/{class}', ['as' => 'spell.sortbyclass', 'uses' => 'SpellController@sortByClass']);

	Route::post('spell/get/{name}', 'SpellController@get');

	Route::post('spell/comment/{id}', ['as' => 'spell.comment', 'uses' => 'CommentController@commentSpell']);

	Route::post('spell/like/{id}', ['as' => 'spell.like', 'uses' => 'SpellController@like']);

	Route::get('spell/fork/{id}', ['as' => 'spell.fork', 'uses' => 'SpellController@fork']);

	//
	// Monster Routes
	//

	Route::resource('monster', 'MonsterController', ['except' => [
		'index', 'show',
	]]);

	Route::get('monster/fork/{id}', ['as' => 'monster.fork', 'uses' => 'MonsterController@fork']);

	//
	// Misc Routes
	//

	Route::post('report/{type}/{id}', 'ReportController@store');

	Route::get('comment/delete/{id}', 'CommentController@delete');
	Route::get('note/delete/{id}', 'NoteController@delete');

	Route::get('/logout', 'Auth\LoginController@logout');

	Route::post('/comment/{type}/{id}', ['as' => 'comment', 'uses' => 'CommentController@comment']);
	Route::post('/note/{type}/{id}', ['as' => 'note', 'uses' => 'NoteController@note']);

	Route::post('/like/{type}/{id}', ['as' => 'like', 'uses' => 'LikeController@like']);

	//
	// Notification Routes
	//

	Route::get('notifications', function () {
		Auth::user()->unreadNotifications->markAsRead();
		return view('notifications');
	});

	Route::post('notifications/read', function () {
		Auth::user()->unreadNotifications->markAsRead();
		return response()->json([
			'status' => '200',
		]);
	});

	//
	// Campaign Routes
	//

	Route::resource('journal', 'JournalController', ['except' => [
		'show',
	]]);
});

//
// Authentication Routes
//
Route::auth();

Route::get('login/{provider}', [
	'uses' => 'Auth\LoginController@getSocialAuth',
	'as' => 'auth.getSocialAuth',
]);

Route::get('login/callback/{provider}', [
	'uses' => 'Auth\LoginController@getSocialAuthCallback',
	'as' => 'auth.getSocialAuthCallback',
]);

Route::get('auth/setup/{id}/{provider}', function () {
	return view('auth.setup');
});

Route::post('auth/setup', 'Auth\RegisterController@setup');

//
// Misc Routes
//

Route::get('/', function () {
	if (Auth::check()) {
		return Redirect::to('/dashboard');
	} else {
		return view('landing');
	}
});

Route::get('font', function () {
	return view('font');
});

Route::get('privacy', function () {
	return view('privacy');
});

Route::get('useragreement', function () {
	return view('terms');
});

Route::get('ogl', function () {
	return view('ogl');
});

Route::get('blog', ['uses' => 'BlogController@index']);
Route::get('blog/{slug}', ['uses' => 'BlogController@post']);
//
// Monster Routes
//
Route::get('monster/{id}/{key}', ['as' => 'monster.private', 'uses' => 'MonsterController@show']);
Route::resource('monster', 'MonsterController', ['only' => [
	'index', 'show',
]]);

Route::get('monster/sort/{type}', ['as' => 'monster.sort', 'uses' => 'MonsterController@sort']);
Route::get('monster/tag/{tag}', ['as' => 'monster.tag', 'uses' => 'MonsterController@tag']);

//
// Item Routes
//
Route::get('item/{id}/{key}', ['as' => 'item.private', 'uses' => 'ItemController@show']);
Route::resource('item', 'ItemController', ['only' => [
	'index', 'show',
]]);

Route::get('item/sort/{type}', ['as' => 'item.sort', 'uses' => 'ItemController@sort']);

//
// LocationRoutes
//
Route::get('location/{id}/{key}', ['as' => 'location.private', 'uses' => 'LocationController@show']);
Route::resource('location', 'LocationController', ['only' => [
	'index', 'show',
]]);

Route::get('location/sort/{type}', ['as' => 'location.sort', 'uses' => 'LocationController@sort']);

//
// EncounterRoutes
//
Route::get('encounter/{id}/{key}', ['as' => 'encounter.private', 'uses' => 'EncounterController@show']);
Route::resource('encounter', 'EncounterController', ['only' => [
	'index', 'show',
]]);

Route::get('encounter/sort/{type}', ['as' => 'encounter.sort', 'uses' => 'EncounterController@sort']);

//
// Spell Routes
//
Route::get('spell/{id}/{key}', ['as' => 'spell.private', 'uses' => 'SpellController@show']);
Route::resource('spell', 'SpellController', ['only' => [
	'index', 'show',
]]);

Route::get('spell/sort/{type}', ['as' => 'spell.sort', 'uses' => 'SpellController@sort']);

//
// NPC Routes
//
Route::get('npc/{id}/{key}', ['as' => 'npc.private', 'uses' => 'NpcController@show']);
Route::resource('npc', 'NpcController', ['only' => [
	'index', 'show',
]]);

Route::get('npc/sort/{type}', ['as' => 'npc.sort', 'uses' => 'NpcController@sort']);

//
// Initiative Routes
//
Route::get('combat', 'CombatController@index');

//
// Rules Routes
//
Route::get('rule', 'RuleController@index');
Route::get('rule/{slug}', 'RuleController@show');
Route::get('rule/section/{slug}', 'RuleController@section');

//Route::get('cleanup', 'DashboardController@cleanup');
