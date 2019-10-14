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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nip');
            $table->unsignedBigInteger('agency_id');
            $table->string('username')->unique();
            $table->timestamp('username_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function($table){
            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->foreign('role_id')->references('id')->on('roles');
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
