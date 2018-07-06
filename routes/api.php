<?php
declare( strict_types = 1 );

# ip:port/api/
Route::group([
	'middleware' => [
		'api',
	],
], function () {

	Route::get('', function (){
		Cache::put('bar', 1, 10);
		dd(Cache::get('bar'));
		return;
	});

	Route::get('/1', 'Instagram\InstagramController@getFeed');
	Route::get('/post', 'Instagram\InstagramController@post');

	# Auth routs
	Route::group(['prefix' => 'auth'], function () {
		Route::post('signup', 'Auth\AuthController@register');
		Route::post('login', 'Auth\AuthController@login');

		Route::group(['middleware' => 'jwt.auth'], function () {
			# Get user data by its token
			Route::get('user', 'Auth\AuthController@user');
			# Invalidate user token
			Route::post('logout', 'Auth\AuthController@logout');
		});
		# Refresh current token
		Route::group(['middleware' => 'jwt.refresh'], function () {
			Route::get('/token/refresh', 'Auth\AuthController@refresh');
		});
	});

});
