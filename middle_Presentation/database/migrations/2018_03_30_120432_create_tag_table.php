<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag', function (Blueprint $table) {
            $table->increments('pta_id');
            $table->Integer('post_id')->unsigned();
            $table  ->foreign('post_id')
                    ->references('post_id')->on('post')
                    ->onDelete('cascade');
            $table->Integer('brd_id')->unsigned();
            $table  ->foreign('brd_id')
                    ->references('brd_id')->on('boards')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('tag');
    }
}
