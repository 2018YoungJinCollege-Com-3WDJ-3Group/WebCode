<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postfile', function (Blueprint $table) {
            $table->increments('pfi_id');
            $table->Integer('post_id');
            $table->Integer('brd_id');
            $table->Integer('mem_id');
            $table->string('pfi_originname');
            $table->Integer('pfi_download');
            $table->Integer('pfi_filesize');
            $table->Integer('pfi_width');
            $table->Integer('pfi_height');
            $table->string('pfi_type');
            $table->Integer('pfi_is_image');
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
        Schema::dropIfExists('postfile');
    }
}
