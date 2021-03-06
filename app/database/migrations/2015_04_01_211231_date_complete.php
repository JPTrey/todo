<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DateComplete extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tasks', function($newcolumn)
		{
			$newcolumn->date('date_complete');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tasks', function($newcolumn)
		{
			$newcolumn->dropcolumn('date_complete');
		});
	}

}
