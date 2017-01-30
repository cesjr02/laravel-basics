<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('users', ['uses' => 'UsersController@index']);

Route::get('users/create', ['uses' => 'UsersController@create']);
Route::post('users', ['uses' => 'UsersController@store']);

// route to user profile
Route::get('profile', 'UsersController@profile');
// update avatar
Route::post('profile', 'UsersController@update_avatar');


// commented code same as route above
/* 
Route::get('users', function () {
	$users = [
		'0' => [
		'first_name' => 'CJ',
		'last_name' => 'Sheets',
		'location' => 'La Crosse'
		],
		'1' => [
		'first_name' => 'Hannah',
		'last_name' => 'Hermes',
		'location' => 'Tomah'
		]
	];
	return $users;
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index');
