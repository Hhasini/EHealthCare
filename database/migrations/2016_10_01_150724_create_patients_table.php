<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('member_id');
			$table->string('name');
                        $table->string('nic')->unique();
                        $table->string('dob');
                        $table->string('address');
			$table->string('email');	
			$table->string('phone');
                        $table->enum('sex', array('F', 'M'));
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
		Schema::drop('patients');
	}

}
