<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickerTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticker', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('identifier');

			$table->string('title');
			$table->text('description');

			$table->timestamps();
		});

		Schema::create('ticker_items', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('ticker_id')->index();

			$table->string('title');
			$table->text('description');

			$table->string('media_preview')->nullable()->default(null);

			$table->string('link')->nullable()->default(null);

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
		Schema::drop('ticker');
		Schema::drop('ticker_items');
	}

}
