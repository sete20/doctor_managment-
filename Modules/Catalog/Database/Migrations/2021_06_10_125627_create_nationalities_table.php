<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNationalitiesTable extends Migration {

	public function up()
	{
		Schema::create('nationalities', function(Blueprint $table) {
			$table->increments('id');
            $table->string('title');
			$table->tinyInteger('status')->default('1');
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nationalities');
	}
}