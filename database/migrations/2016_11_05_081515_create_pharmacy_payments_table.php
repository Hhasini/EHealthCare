<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacyPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pharmacy_payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('patient_name');
			$table->string('sold_to');
			$table->string('doctor_name');
			$table->float('amount');
			$table->dateTime('payment_date');
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
		Schema::drop('pharmacy_payments');
	}

}
