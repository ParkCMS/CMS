<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEkomiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ekomi', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('identifier');

			$table->string('source');
			$table->string('name');
			$table->string('link');
			$table->float('rating');
			$table->integer('count');

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
		Schema::drop('ekomi');
	}

}
