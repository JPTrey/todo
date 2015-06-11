<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($newcolumn) {
			$newcolumn->boolean('hide_empty');
			$newcolumn->boolean('notify');
			$newcolumn->boolean('auto_push');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($newcolumn)
		{
			$newcolumn->dropcolumn('hide_empty');
			$newcolumn->dropcolumn('notify');
			$newcolumn->dropcolumn('auto_push');
		});
	}

}
