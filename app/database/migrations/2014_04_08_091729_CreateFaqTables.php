<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faq', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('identifier')->unique();

			$table->timestamps();
		});

		Schema::create('faq_questions', function(Blueprint $table) {
			$table->increments('id');

			$table->integer('faq_id')->index();

			$table->string('question');
			$table->text('answer');

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
		Schema::drop('faq');
		Schema::drop('faq_questions');
	}

}
