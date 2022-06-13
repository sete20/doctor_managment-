<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Courses\Entities\ClientCourse;

class CreateClientCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price')->nullable();
            $table->float('offer_price')->nullable();
            $table->boolean('is_offered')->default(false);
            $table->enum('status', ClientCourse::$status)->default('pending');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');
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
        Schema::dropIfExists('client_course');
    }
}
