<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsgroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardsgroup', function (Blueprint $table) {
            //PK
            $table->increments('bgr_id');
            //게시판 그룹 키
            $table->string('bgr_key');
            //게시판 그룹이름
            $table->string('bgr_name');
            //게시판 그룹 정열
            $table->unsignedInteger('bgr_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
        Schema::dropIfExists('boardsgroup');
    }
}
