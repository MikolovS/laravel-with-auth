<?php /** @noinspection PhpDynamicAsStaticMethodCallInspection */

use App\Models\Instagram\InstaAccount;
use Illuminate\Database\Seeder;

class InstagramAccountsSeeder extends Seeder
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
				'name' => 'studioapi',
			],
		];

		InstaAccount::insert($acounts);
	}
}
