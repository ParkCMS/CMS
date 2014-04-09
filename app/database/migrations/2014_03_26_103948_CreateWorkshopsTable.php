<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workshops', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('identifier')->index();

			$table->string('title');
			$table->text('content');
			$table->text('terms');
			$table->text('registration_mail');

			$table->date('date');
			$table->integer('seats')->unsigned();

			$table->boolean('active');

			$table->timestamps();
		});

		Schema::create('workshop_parts', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('workshop_id')->index();

			$table->string('title');
			$table->text('description');
			$table->float('price');

			$table->integer('part_type');
			$table->string('select_values');

			$table->boolean('connected_with_seats');
			$table->integer('order');

			$table->timestamps();
		});

		Schema::create('workshop_registrations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('internal_id')->unique();

			$table->string('title');
			$table->string('first_name');
			$table->string('middle_name');
			$table->string('sur_name');

			$table->string('address');
			$table->string('institution');
			$table->string('city');
			$table->string('zip');
			$table->string('country');

			$table->string('email');
			$table->string('phone');
			$table->string('fax');

			$table->float('total_amount');

			$table->string('payment_type');
			$table->text('payment_data');

			$table->timestamps();
		});

		Schema::create('workshop_part_registration', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('part_id')->index();
			$table->integer('registration_id')->index();

			$table->text('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workshops');
		Schema::drop('workshop_parts');
		Schema::drop('workshop_registrations');
		Schema::drop('workshop_part_registration');
	}

}
