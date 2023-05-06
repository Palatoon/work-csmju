<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Access_History', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->unsignedBigInteger('Room_ID')->nullable();
            $table->foreign('Room_ID')->references('id')->on('rooms');
            $table->unsignedBigInteger('Device_ID')->nullable();
            $table->foreign('Device_ID')->references('id')->on('devices');
            $table->string('cardNo')->nullable();
            $table->string('Temperature')->nullable();
            $table->datetime('AccessTime')->nullable();
            $table->datetime('create_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Access_History');
    }
}
