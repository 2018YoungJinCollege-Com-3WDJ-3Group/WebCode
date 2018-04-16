<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     
    public function up()
    {
        Schema::create('score', function (Blueprint $table) {
            $table->increments('score_id');
            $table->string('writer');
            $table->string('title');
            $table->string('category')->nullable();
            $table->string('comment')->nullable();
            $table->text('scorestring');
            $table->string('thumnail')->nullable();
            $table->boolean('confirmed')->default(true);
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
        Schema::dropIfExists('score');
    }
}
