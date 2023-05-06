<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('building')->nullable();
            $table->foreign('building')->references('id')->on('buildings');
            $table->unsignedBigInteger('area')->nullable();
            $table->foreign('area')->references('id')->on('areas');
            $table->unsignedBigInteger('room')->nullable();
            $table->foreign('room')->references('id')->on('rooms');
            $table->unsignedBigInteger('device')->nullable();
            $table->foreign('device')->references('id')->on('devices');
            $table->string('type')->nullable();
            $table->string('first_operator')->nullable();
            $table->string('first_value')->nullable();
            $table->string('logic')->nullable();
            $table->string('second_operator')->nullable();
            $table->string('second_value')->nullable();
            $table->unsignedBigInteger('command')->nullable();
            $table->foreign('command')->references('id')->on('commands');
            $table->boolean('is_active');
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
        Schema::dropIfExists('conditions');
    }
}
