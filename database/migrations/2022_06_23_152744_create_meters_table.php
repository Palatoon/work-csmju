<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SensorLists', function (Blueprint $table) {
            $table->bigIncrements('SensorID');
            $table->string('Label')->nullable();
            $table->string('TokenGuid')->nullable();
            $table->unsignedBigInteger('building')->nullable();
            $table->foreign('building')->references('id')->on('buildings');
            $table->unsignedBigInteger('area')->nullable();
            $table->foreign('area')->references('id')->on('areas');
            $table->unsignedBigInteger('room')->nullable();
            $table->foreign('room')->references('id')->on('rooms');
            $table->string('Image')->nullable();
            $table->boolean('Status')->default(0);
            $table->boolean('Notify')->default(0);
            $table->boolean('active_license')->nullable();
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
        Schema::dropIfExists('SensorLists');
    }
}
