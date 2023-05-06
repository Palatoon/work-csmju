<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('chart_id')->nullable();
            $table->foreign('chart_id')->references('id')->on('charts');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('devices');
            $table->unsignedBigInteger('datacode_id')->nullable();
            $table->foreign('datacode_id')->references('id')->on('DataCode');
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
        Schema::dropIfExists('chart_devices');
    }
}
