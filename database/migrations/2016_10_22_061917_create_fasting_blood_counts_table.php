<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFastingBloodCountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fasting_blood_counts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('visit_id');
			$table->integer('patientSchId');
			$table->date('enterDate');
			$table->float('fbs');
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
		Schema::drop('fasting_blood_counts');
	}

}
