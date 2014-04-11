<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeWorkshopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('workshop', function(Blueprint $table)
		{
			$table->dropColumn('registration_mail');

			$table->string('registration_mail')->after('terms');
			$table->text('registration_mail_body')->after('registration_mail');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('workshop', function(Blueprint $table)
		{
			//
		});
	}

}