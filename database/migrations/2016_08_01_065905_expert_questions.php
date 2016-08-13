<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpertQuestions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('experts_questions', function (Blueprint $table) {
            $table->increments('question_id');
            $table->string("question_slug");
            $table->integer("question_category_id");
            $table->foreign("question_category_id")->references("category_id")->on('categories')->onDelete('CASCADE');
            $table->text("question_text");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
