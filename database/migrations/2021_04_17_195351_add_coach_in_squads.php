<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoachInSquads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('squads', function (Blueprint $table) {
            $table->unsignedBigInteger('coach_id');

            $table->foreign('coach_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('squads', function (Blueprint $table) {
            $table->dropColumn('coach_id');
        });
    }
}
