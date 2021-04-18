<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('race_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('points');
            $table->timestamps();

            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_user');
    }
}
