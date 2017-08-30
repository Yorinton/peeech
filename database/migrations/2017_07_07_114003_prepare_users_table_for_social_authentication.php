<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrepareUsersTableForSocialAuthentication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            // Making email and password nullable
            $table->string('email',191)->nullable()->change();
            $table->string('password',255)->nullable()->change();
            $table->string('sex',11)->nullable()->change();
            $table->date('birthday')->nullable()->change();
            $table->string('img_path',255)->nullable()->change();
            $table->string('introduction',1000)->nullable()->change();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('email',191)->nullable(false)->change();
            $table->string('password',255)->nullable(false)->change();
            $table->string('sex',11)->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->string('img_path',255)->nullable(false)->change();
            $table->string('introduction',1000)->nullable(false)->change();                       
        });
    }
}
