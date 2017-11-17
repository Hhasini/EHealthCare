<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullBloodCountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('full_blood_counts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('visit_id');
			$table->integer('patientSchId');
			$table->date('enterDate');
			$table->float('wbc');
			$table->float('rbc');
			$table->float('hgb');
			$table->float('platelet');
			$table->float('neut');
			$table->float('lymph');
			$table->float('mono');
			$table->float('eos');
			$table->float('baso');
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
		Schema::drop('full_blood_counts');
	}

}
