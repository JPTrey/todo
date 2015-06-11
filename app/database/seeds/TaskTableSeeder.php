<?php

class TaskTableSeeder extends Seeder {
	
	public function run() {
		$faker = Faker\Factory::create();

		for ($i=0; $i < 1000; $i++) { 
			$task = Task::create(array(
				'user_id' => $faker->numberBetween(1,100),
				'name' => $faker->word,
				'priority' => $faker->randomElement($array = array(
					'today',
					'tomorrow',
					'week',
					'two weeks',
					'month',
					'season',
					'year'
				)),
				'complete' => $faker->boolean(50),
				'remember_token' => str_random(50)
			));
		}
	}
}