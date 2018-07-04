<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Flugg\Responder\Http\Responses\ErrorResponseBuilder;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
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
	 * @return SuccessResponseBuilder
	 */
	public function register (RegisterFormRequest $request)
	{
		$user = User::create($request->all());

		return $this->success($user);
	}

	/**
	 * @param LoginRequest $request
	 * @return ErrorResponseBuilder|SuccessResponseBuilder
	 */
	public function login (LoginRequest $request)
	{
		$credentials = $request->only('name', 'password');

		if ( ! $token = JWTAuth::attempt($credentials))
			return $this->error(400, 'Invalid Credentials.');

		return $this->success($token);
	}

	/**
	 * @return SuccessResponseBuilder
	 */
	public function user ()
	{
		$user = Auth::user();

		return $this->success($user);
	}

	/**
	 * @return ErrorResponseBuilder|SuccessResponseBuilder
	 */
	public function logout ()
	{
		try {
			$token = JWTAuth::getToken()->get();

			JWTAuth::invalidate($token);

			return $this->success();

		} catch (\Exception $exception) {
			return $this->error(400, $exception->getMessage());
		}
	}

	/**
	 * @return SuccessResponseBuilder
	 */
	public function refresh ()
	{
		return $this->success();
	}
}