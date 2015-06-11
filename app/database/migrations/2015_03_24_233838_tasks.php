<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tasks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function($newtable) {
			$newtable->increments('id');
			$newtable->integer('user_id');
			$newtable->string('name', 50);
			$newtable->string('priority', 20);	// today, tomorrow, this week, etc.
			$newtable->boolean('complete');
			$newtable->rememberToken();
			$newtable->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasks');
	}

}
