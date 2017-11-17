<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckupShedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checkup_shedules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('resourceId');
			$table->integer('timeSlot');
			$table->date('date');
			$table->integer('count');
			$table->string('status');
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
		Schema::drop('checkup_shedules');
	}

}
