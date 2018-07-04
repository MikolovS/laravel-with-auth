<?php

Route::group([
	'middleware' => [
		'api',
	],
], function () {

	Route::group(['prefix' => 'auth'], function () {

		Route::post('signup', 'Auth\AuthController@register');
		Route::post('login', 'Auth\AuthController@login');

		Route::group(['middleware' => 'jwt.auth'], function () {
			Route::get('user', 'Auth\AuthController@user');
			Route::post('logout', 'Auth\AuthController@logout');
		});

		Route::group(['middleware' => 'jwt.refresh'], function () {
			Route::get('/token/refresh', 'Auth\AuthController@refresh');
		});
	});

});
