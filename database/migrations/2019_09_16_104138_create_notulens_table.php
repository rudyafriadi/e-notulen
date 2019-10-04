<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotulensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notulens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agenda_rapat');
            $table->string('j_rapat');
            $table->string('instansi');
            $table->string('users_id');
            // $table->unsignedBigInteger('users_id');
            // $table->foreign('users_id')->references('id')->on('users');
            $table->integer('status');
            $table->string('tanggal');
            $table->string('hari');
            $table->string('file');
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
        Schema::dropIfExists('notulens');
    }
}
