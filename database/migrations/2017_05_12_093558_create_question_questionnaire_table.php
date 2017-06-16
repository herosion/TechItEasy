<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_questionnaire', function (Blueprint $table) {
            
            $table->integer('questionnaire_id')->unsigned()->nullable();
            $table->integer('question_id')->unsigned()->nullable();
            
            $table->unique(['questionnaire_id', 'question_id']);

            #foreign keys
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->onDelete('SET NULL');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('SET NULL');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_questionnaire');
    }
}
