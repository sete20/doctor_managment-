<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->string('token', 225)->nullable();
			$table->enum('os', array('android', 'ios'));
			$table->string('serial_number');
			$table->string('tokenable_type');
			$table->integer('tokenable_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}