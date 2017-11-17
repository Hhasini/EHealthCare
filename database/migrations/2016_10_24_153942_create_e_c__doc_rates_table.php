<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateECDocRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_c__doc_rates', function(Blueprint $table)
		{
			$table->increments('rid');
			$table->string('doc_id');
			$table->double('rate');
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
		Schema::drop('e_c__doc_rates');
	}

}
