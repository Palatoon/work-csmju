<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceDatacodeConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_datacode_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('devices');
            $table->unsignedBigInteger('datacode_id')->nullable();
            $table->foreign('datacode_id')->references('id')->on('DataCode');
            $table->enum('condition', ['<', '>', '<=', '>='])->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('device_datacode_conditions');
    }
}
