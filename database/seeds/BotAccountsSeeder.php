<?php /** @noinspection PhpDynamicAsStaticMethodCallInspection */

use App\Models\Instagram\BotAccount;
use Illuminate\Database\Seeder;

/**
 * Class BotAccountsSeeder
 */
class BotAccountsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run ()
	{
		$acounts = [
			[
				'name'     => 'api855',
				'email'    => 'api_instagram_1@meta.ua',
				'password' => 'api_instagram_1',
			],
		];

		BotAccount::insert($acounts);
	}
}
