<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            //게시글 테이블의 pk
            $table->increments('post_id');
            //게시판 FK
            $table->unsignedInteger('brd_id');
            $table  ->foreign('brd_id')
                    ->references('brd_id')->on('boards')
                    ->onDelete('cascade');
            //게시글 지은이
            $table->string('writer');
            $table->string('category');
            $table->Integer('count')->default(0);
            $table->Integer('like')->default(0);
            $table->string('title');
            $table->string('body');
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
        Schema::dropIfExists('post');
    }
}
