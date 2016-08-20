<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('sub_category_id');
            $table->integer("rel_category_id");
            $table->foreign("rel_category_id")->references("category_id")->on("categories")->onDelete("CASCADE");
            $table->string("sub_category_slug");
            $table->string("sub_category_name");
            $table->text("sub_category_description")->nullable();
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
        Schema::drop("sub_categories");
    }
}
