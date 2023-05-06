<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('template_id');
            $table->string('name');
            $table->string('address');
            $table->string('type');
            $table->Integer('hours');
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->boolean('deleted')->default(0);
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
        Schema::dropIfExists('permissions');
    }
}
