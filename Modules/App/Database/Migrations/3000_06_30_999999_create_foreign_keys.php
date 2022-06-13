<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

    public function up()
    {
//        Schema::table('client_completions', function (Blueprint $table) {
//            $table->foreign('client_id')->references('id')->on('clients')
//                ->onDelete('cascade')
//                ->onUpdate('restrict');
//        });
//        Schema::table('client_completions', function (Blueprint $table) {
//            $table->foreign('lesson_id')->references('id')->on('lessons')
//                ->onDelete('cascade')
//                ->onUpdate('restrict');
//        });
    }

    public function down()
    {
//        Schema::table('client_completions', function (Blueprint $table) {
//            $table->dropForeign('client_completions_client_id_foreign');
//        });
//        Schema::table('client_completions', function (Blueprint $table) {
//            $table->dropForeign('client_completions_lesson_id_foreign');
//        });
    }
}