<?php
declare( strict_types = 1 );

namespace App\Clients;

use App\Drivers\Storage\Redis;
use App\Exceptions\Instagram\NoBotAccountException;
use App\Models\Instagram\BotAccount;
use InstagramAPI\Instagram;

/**
 * Class InstaClient
 * @package App\Clients\InstaClient
 */
class InstaClient
{
	public function __construct ()
	{
		# stupid package security
		Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
	}

	/**
	 * Get random instagram bot's login data
	 *
	 * @return BotAccount
	 */
	protected static function getBot () : BotAccount
	{
		/** @noinspection PhpDynamicAsStaticMethodCallInspection */
		$user = BotAccount::inRandomOrder()->first();

		if (is_null($user))
			throw new NoBotAccountException();

		return $user;
	}

	/**
	 * @return array
	 */
	public static function getDefaultStorage () : array
	{
		return [
			'storage' => 'custom',
			'class'   => new Redis(),
		];
	}

	/**
	 * Get logged instagram model
	 *
	 * @param BotAccount|null $botAccount
	 * @return Instagram
	 */
	public static function make (BotAccount $botAccount = null) : Instagram
	{
		if (is_null($botAccount))
			$botAccount = self::getBot();

		$instagram = new Instagram(false, false, self::getDefaultStorage());

		$instagram->login($botAccount->name, $botAccount->password);

		return $instagram;
	}
}