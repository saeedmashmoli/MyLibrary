<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->biginteger('library_id')->unsigned()->nullable();
            $table->foreign('library_id')->references('id')->on('libraries');
            $table->integer('mainservice_id')->unsigned()->nullable();
            $table->foreign('mainservice_id')->references('id')->on('services');
            $table->integer('partialservice_id')->unsigned()->nullable();
            $table->foreign('partialservice_id')->references('id')->on('services');
            $table->integer('questiontype_id')->unsigned()->nullable();
            $table->foreign('questiontype_id')->references('id')->on('questiontypes');
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
        Schema::dropIfExists('questions');
    }
}
