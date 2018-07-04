<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
	/**
	 * @param RegisterFormRequest $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function register (RegisterFormRequest $request)
	{
		$user = User::create($request->all());

		return response([
			'status' => 'success',
			'data'   => $user,
		]);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function login (Request $request)
	{
		$credentials = $request->only('name', 'password');

		if ( ! $token = JWTAuth::attempt($credentials)) {
			return response([
				'status' => 'error',
				'error'  => 'invalid.credentials',
				'msg'    => 'Invalid Credentials.',
			], 400);
		}
		return response([
			'status' => 'success',
			'token'  => $token,
		]);
	}

	/**
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function user ()
	{
		/** @noinspection PhpDynamicAsStaticMethodCallInspection */
		$user = User::find(Auth::user()->id);

		return response([
			'status' => 'success',
			'data'   => $user,
		]);
	}

	/**
	 * Log out
	 * Invalidate the token, so user cannot use it anymore
	 * They have to relogin to get a new token
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function logout ()
	{
		try {
			$token = JWTAuth::getToken()
			                ->get();

			JWTAuth::invalidate($token);

			return response([
				'status'  => 'success',
				'message' => 'You have successfully logged out.',
			]);
		} catch (\Exception $exception) {
			return response([
				'status'  => 'error',
				'message' => $exception->getMessage(),
			]);
		}
	}

	/**
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function refresh ()
	{
		return response([
			'status' => 'success',
		]);
	}
}