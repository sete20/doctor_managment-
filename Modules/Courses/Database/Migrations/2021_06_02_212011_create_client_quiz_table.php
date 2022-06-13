<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Courses\Entities\ClientCourse;

class CreateClientQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_quiz', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wright_answers_count');
            $table->integer('question_count');
            $table->unsignedInteger('client_id');
            $table->unsignedBigInteger('quiz_id');
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
        Schema::dropIfExists('client_quiz');
    }
}
