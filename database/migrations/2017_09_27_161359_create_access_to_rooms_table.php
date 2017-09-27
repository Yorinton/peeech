<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_to_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('room_id')
                    ->references('id')
                    ->on('rooms')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_to_rooms');
    }
}
