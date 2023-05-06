<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesInitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices_init', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('devices');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->boolean('start_time')->nullable();
            $table->boolean('end_time')->nullable();
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
        Schema::dropIfExists('devices_init');
    }
}
