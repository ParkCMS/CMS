<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dirlist', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('identifier')->unique();
			$table->string('title');
			$table->string('folder');
			$table->string('filter')->default('*');

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
		Schema::drop('dirlist');
	}

}
