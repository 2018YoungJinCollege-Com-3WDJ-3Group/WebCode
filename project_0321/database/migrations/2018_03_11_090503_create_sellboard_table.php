<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellboard', function (Blueprint $table) {
            $table->increments('id');
            $table->string('seller');
            $table->string('scorenum')->nullable();
            $table->Integer('price')->default(0);
            $table->string('category');
            $table->Integer('sellnum')->default(0);
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
        Schema::dropIfExists('sellboard');
    }
}
