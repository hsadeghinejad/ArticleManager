<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('title');
            $table->string('slug');

            $table->timestamps();
        });

        Schema::create('article_category', function (Blueprint $table){
            $table->engine = 'InnoDB';

            $table->integer('article_id')->unsigned();
            $table->foreign('article_id')->refrences('id')->on('articles')->onDeleted('restricted');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->refrences('id')->on('categories')->onDeleted('restricted');

            $table->primary(['article_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
