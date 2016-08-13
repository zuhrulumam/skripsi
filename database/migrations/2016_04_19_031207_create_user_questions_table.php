<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_questions', function (Blueprint $table) {
            $table->integer("rel_user_id");
            $table->foreign("rel_user_id")->references("id")->on("users")->onDelete("CASCADE");
            $table->integer("rel_question_id");
            $table->foreign("rel_question_id")->references("question_id")->on("questions")->onDelete("CASCADE");
            $table->tinyInteger("rel_answer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_questions');
    }

}
