<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseMedicinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_medicines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('payment_id');
			$table->integer('medicine_id');
			$table->integer('amount');
			$table->float('price');
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
		Schema::drop('purchase_medicines');
	}

}
