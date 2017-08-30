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
            $table->string('name',255);
            $table->string('email')->unique();
            $table->string('sex',11);
            $table->date('birthday');
            $table->string('img_path',255);
            $table->string('introduction',1000);
            $table->string('password',255);
            $table->rememberToken();//remember_token追加
            $table->timestamps();//created_atとupdated_atのカラム追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
