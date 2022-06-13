<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHomeTable extends Migration {

	public function up()
	{
		Schema::create('home', function(Blueprint $table) {
			$table->increments('id');
            $table->string('title');
			$table->tinyInteger('status')->default('1');
            $table->integer('order')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('home');
	}
}