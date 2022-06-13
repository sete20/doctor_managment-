<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifiablesTable extends Migration {

	public function up()
	{
		Schema::create('notifiables', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('notification_id');
			$table->tinyInteger('is_read')->default('0');
			$table->string('notifiable_type');
			$table->integer('notifiable_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifiables');
	}
}