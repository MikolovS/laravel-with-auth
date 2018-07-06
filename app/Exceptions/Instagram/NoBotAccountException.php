<?php

namespace App\Exceptions\Instagram;

use Flugg\Responder\Exceptions\Http\HttpException;


/**
 * Class NoBotAccountException
 * @package App\Exceptions\Instagram
 */
class NoBotAccountException extends HttpException
{
	/**
	 * The HTTP status code.
	 *
	 * @var int
	 */
	protected $status = 400;

	/**
	 * The error code.
	 *
	 * @var string|null
	 */
	protected $errorCode = 'instagram_service';

	/**
	 * The error message.
	 *
	 * @var string|null
	 */
	protected $message = 'No Bot Accounts found!';
}