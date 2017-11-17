<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medicine_carts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('medicine_id')->unique();
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
		Schema::drop('medicine_carts');
	}

}
