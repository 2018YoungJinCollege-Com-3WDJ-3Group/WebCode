<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//게시판 관리 모델
class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            //게시판 고유 번호
            $table->increments('brd_id');
            //$table->Integer('grpno');
            //$table->Integer('grpord');
            //$table->Integer('grpdepth');
            
            //게시판 그룹 테이블 PK
            $table->unsignedInteger('bgr_id');
            $table  ->foreign('bgr_id')
                    ->references('bgr_id')->on('boardsgroup')
                    ->onDelete('cascade');
            //게시판 주소
            $table->string('brd_key');
            //게시판 명
            $table->string('brd_name');
            //게시판 정렬 순서
            $table->unsignedInteger('brd_order');
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
        Schema::dropIfExists('post');
        Schema::dropIfExists('sharepost');
        Schema::dropIfExists('boardcategory');
        Schema::dropIfExists('boards');
    }
}
