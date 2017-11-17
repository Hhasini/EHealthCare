<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancelECschedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cancel_e_cschedules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('schedule_id');
			$table->string('reason_to_cancel');
			$table->string('doc_id');
			$table->string('room');
			$table->dateTime('shift_start');
			$table->dateTime('shift_end');
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
		Schema::drop('cancel_e_cschedules');
	}

}
