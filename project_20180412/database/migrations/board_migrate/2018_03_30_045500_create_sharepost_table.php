<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharepostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sharepost', function (Blueprint $table) {
             $table->increments('post_id');
            //게시판 테이블의 pk
            $table->unsignedInteger('brd_id');
            $table  ->foreign('brd_id')
                    ->references('brd_id')->on('boards')
                    ->onDelete('cascade');
            $table->string('writer');
            $table->unsignedInteger('score_id');
            $table  ->foreign('score_id')
                    ->references('score_id')->on('score')
                    ->onDelete('cascade');
            $table->Integer('price')->default(0);
            $table->string('category');
            $table->Integer('count')->default(0);
            $table->Integer('like')->default(0);
            $table->string('title');
            $table->text('body');
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
        Schema::dropIfExists('sharepost');
    }
}
