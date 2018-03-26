<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retain', function (Blueprint $table) {
            //foreign key
            $table->integer('user_id')->unsigned();
            $table  ->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->integer('score_id')->unsigned();
            $table  ->foreign('score_id')
                    ->references('num')->on('score')
                    ->onDelete('cascade');
            $table->timestamps();
            //primary key
            $table->primary(['user_id', 'score_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('retain');
      
    }
}
