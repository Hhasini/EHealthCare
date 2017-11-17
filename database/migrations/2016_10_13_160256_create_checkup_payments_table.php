<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckupPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checkup_payments', function(Blueprint $table)
		{
			$table->increments('pid');
			$table->integer('scheduleId');
			$table->integer('patientId');
			$table->date('date');
			$table->float('amount');
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
		Schema::drop('checkup_payments');
	}

}
