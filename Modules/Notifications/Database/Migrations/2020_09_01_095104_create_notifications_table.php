<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('body')->nullable();
			$table->string('notifiable_type')->nullable();
			$table->integer('notifiable_id')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}