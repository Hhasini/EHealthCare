<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelingpaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('channelingpayments', function(Blueprint $table)
		{
			$table->increments('payment_id');
                        $table->integer('booking_id');
                        $table->string('transaction_id');
                        $table->string('currency_code');
                        $table->string('payment_status');
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
		Schema::drop('channelingpayments');
	}

}
