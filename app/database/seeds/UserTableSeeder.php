<?php

class UserTableSeeder extends Seeder {
	
	public function run() {
		$faker = Faker\Factory::create();

		for ($i=0; $i < 100; $i++) { 
			$user = User::create(array(
				'email' => $faker->unique->email,
				'password' => Hash::make($faker->word),
				'remember_token' => str_random(50)
			));
		}
	}
}