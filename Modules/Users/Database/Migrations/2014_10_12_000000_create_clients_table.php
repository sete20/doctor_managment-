<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->integer('points')->default(0);
			$table->string('password')->nullable();
			$table->string('pin_code')->nullable();
			$table->datetime('pin_code_date_expired')->nullable();
			$table->integer('screen_shot_num')->default(0);
			$table->enum('activation', array('pending', 'active', 'deactivate'))->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}