<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateESchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_schedules', function(Blueprint $table)
		{
			$table->increments('schedule_id');
			$table->string('doc_id');
			$table->string('room');
			$table->dateTime('shift_start');
			$table->dateTime('shift_end');
			$table->integer('max_bookings')->nullable();
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
		Schema::drop('e_schedules');
	}

}
