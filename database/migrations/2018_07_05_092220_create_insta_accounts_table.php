<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInstaAccountsTable
 */
class CreateInstaAccountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up ()
	{
		Schema::create('insta_accounts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')
			      ->unique()
				  ->comment = 'Account name in Instagram';
			$table->timestamps();
		});

		DB::statement("COMMENT ON TABLE insta_accounts IS 'Instagram accounts'");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down ()
	{
		Schema::dropIfExists('insta_accounts');
	}
}
