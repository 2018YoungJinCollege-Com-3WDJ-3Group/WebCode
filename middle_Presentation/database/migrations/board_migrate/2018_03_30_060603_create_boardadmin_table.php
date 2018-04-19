<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardadminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardadmin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('brd_id');
            $table  ->foreign('brd_id')
                    ->references('brd_id')->on('boards')
                    ->onDelete('cascade');
            $table->unsignedInteger('mem_id');
            $table  ->foreign('mem_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boardadmin');
    }
}
