<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToExpertquestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("experts_questions", function(Blueprint $table){
            $table->integer("first_category_comparation")->default(1);
            $table->integer("second_category_comparation")->default(1);
            $table->foreign("first_category_comparation")->references("category_id")->on("categories")->onDelete("CASCADE");
            $table->foreign("second_category_comparation")->references("category_id")->on("categories")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table("experts_questions", function(Blueprint $table){
            $table->dropColumn("first_category_comparation");
            $table->dropColumn("second_category_comparation");
        });
    }
}
