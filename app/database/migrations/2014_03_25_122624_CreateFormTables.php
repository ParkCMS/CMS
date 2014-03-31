<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forms', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('identifier');
			$table->string('email');
			$table->string('subject');

			$table->text('attributes');

			$table->timestamps();
		});

		Schema::create('fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_id')->index();

			$table->string('type');
			$table->string('name');

			$table->text('values');
			$table->text('attributes');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('forms');
		Schema::drop('fields');
	}

}