<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("ip")->nullable();
            $table->string("macaddress")->nullable();
            $table->string("serial_id")->nullable();
            $table->string("cache_id")->nullable();
            $table->string("name")->nullable();
            $table->string("name_en")->nullable();
            $table->string("brand")->nullable();
            $table->string("model")->nullable();
            $table->text("description")->nullable();
            $table->string("username")->nullable();
            $table->text("password")->nullable();
            $table->unsignedBigInteger('device_type_id')->nullable();
            $table->foreign('device_type_id')->references('id')->on('device_types');
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->unsignedBigInteger('home_assistant_id')->nullable();
            $table->foreign('home_assistant_id')->references('id')->on('home_assistant');
            $table->datetime('sync_date')->nullable()->default('2000-01-01 00:00:00');
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();
            $table->string("privilege_group_id")->nullable();
            $table->string("entity_id")->nullable();
            $table->string("unit")->nullable();
            $table->boolean("visible")->nullable();
            $table->enum('display_status', ['always', 'hover', 'hide'])->default('hover');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('device');
    }
}
