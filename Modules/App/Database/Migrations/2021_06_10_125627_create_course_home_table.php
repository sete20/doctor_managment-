<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseHomeTable extends Migration {

	public function up()
	{
		Schema::create('course_home', function(Blueprint $table) {
			$table->increments('id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedInteger('home_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('course_home');
	}
}