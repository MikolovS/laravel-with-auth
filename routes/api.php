<?php

# ip:port/api/
Route::group([
	'middleware' => [
		'api',
	],
], function () {
	# Методы аутентификации
	Route::group(['prefix' => 'auth'], function () {
		# Регистрация пользователя
		Route::post('signup', 'Auth\AuthController@register');
		# Логин в систему с получением токена
		Route::post('login', 'Auth\AuthController@login');

		Route::group(['middleware' => 'jwt.auth'], function () {
			# Получение данных о пользователе по токену
			Route::get('user', 'Auth\AuthController@user');
			# Выход из системы(добавления токена в блэклист)
			Route::post('logout', 'Auth\AuthController@logout');
		});
		# Обновление текущего токена
		Route::group(['middleware' => 'jwt.refresh'], function () {
			Route::get('/token/refresh', 'Auth\AuthController@refresh');
		});
	});

});
