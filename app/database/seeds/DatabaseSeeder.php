<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PageSeeder');
		$this->call('TextSeeder');
		$this->call('FormSeeder');
		
		// $this->call('UserTableSeeder');
	}

}