<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_questionnaire', function (Blueprint $table) {
            
            $table->integer('questionnaire_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            
            $table->unique(['questionnaire_id', 'category_id']);

            #foreign keys
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')->onDelete('SET NULL');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_questionnaire');
    }
}
