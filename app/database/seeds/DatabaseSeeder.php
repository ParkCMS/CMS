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
		$this->call('AuthSeeder');

		$this->call('TextSeeder');
		$this->call('FormSeeder');
		$this->call('WorkshopSeeder');
		$this->call('TickerSeeder');
		$this->call('FaqSeeder');
		
	}

}