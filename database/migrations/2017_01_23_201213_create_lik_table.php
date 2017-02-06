<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lik', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lik')->default(0);
            $table->integer('unlik')->default(0);
            $table->integer('id_news')->unsigned();
            $table->foreign('id_news')->references('id')->on('news');
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
        Schema::drop('lik');
    }
}
