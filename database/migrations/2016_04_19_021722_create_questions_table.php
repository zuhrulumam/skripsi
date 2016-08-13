<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('question_id');
            $table->string("question_slug");
            $table->integer("question_category_id");
            $table->foreign("question_category_id")->references("category_id")->on('categories')->onDelete('CASCADE');
            $table->text("question_text");
            $table->timestamps();
        });
        
//        Schema::table('user_questions', function (Blueprint $table) {
//            $table->foreign("rel_question_id")->references("question_id")->on("questions")->onDelete("CASCADE");
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
//        Schema::table('user_questions', function (Blueprint $table) {
//            $table->dropForeign(['rel_question_id']);
//        });
        Schema::drop('questions');
    }

}
