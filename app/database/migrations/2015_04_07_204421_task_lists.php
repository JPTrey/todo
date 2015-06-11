<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskLists extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// create new table
		Schema::create('lists', function($t)
		{
			$t->increments('id');
			$t->text('name');
			$t->integer('user_id');
			$t->rememberToken();
			$t->timestamps();
		});

		// create reference column 
		Schema::table('tasks', function($newcolumn) {
			$newcolumn->integer('list_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lists');

		Schema::table('tasks', function($newcolumn)
		{
			$newcolumn->dropcolumn('list_id');
		});
	}

}
