<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctor_visits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('booking_id');
			$table->integer('patient_id');
			$table->string('doctor_id');
			$table->DateTime('visit_date');
			$table->string('family_history');
			$table->string('diagnosis_notes');
			$table->string('prescription');
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
		Schema::drop('doctor_visits');
	}

}
