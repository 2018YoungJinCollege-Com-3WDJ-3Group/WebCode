<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            //primary key
            $table->increments('num');
            //foreign key
            $table->integer('user_id')->unsigned();
            $table  ->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->string('seller');
            $table->Integer('board_num');
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
        Schema::dropIfExists('historys');
    }
}
