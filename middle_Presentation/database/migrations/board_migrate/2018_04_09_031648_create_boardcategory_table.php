<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardcategory', function (Blueprint $table) {
            $table->increments('bca_id');
            //게시판 테이블의 pk
            $table->unsignedInteger('brd_id');
            $table  ->foreign('brd_id')
                    ->references('brd_id')->on('boards')
                    ->onDelete('cascade');
            $table->string('bca_key');
            $table->string('bca_value');
            $table->string('bca_parent')->nullable();
            $table->unsignedInteger('bca_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boardcategory');
    }
}
