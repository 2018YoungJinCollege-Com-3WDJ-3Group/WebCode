<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('session_id')->nullable();
            $table->string('email')->unique();
            //$table->string('retain')->nullable();
            //$table->string('buy')->nullable();
            //$table->string('like_page')->nullable();
            $table->Integer('point')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   //참조하는(fk가 있는) 테이블 부터 삭제하고 참조되는 테이블을 삭제한다. 
        Schema::dropIfExists('retain');
        Schema::dropIfExists('purchase');
        Schema::dropIfExists('score');
        Schema::dropIfExists('users');
    }
}
