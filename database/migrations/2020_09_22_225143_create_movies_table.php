<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_movies', function (Blueprint $table) {
            $table->bigIncrements('movie_id');
            $table->string('title');
            $table->string('summary');
            $table->string('duration');
            $table->string('image_path');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('category_id')
                ->on('tb_categories');
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
        Schema::dropIfExists('tb_movies');
    }
}
