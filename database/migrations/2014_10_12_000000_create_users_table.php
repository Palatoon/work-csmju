<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->enum('type', ['internal', 'external'])->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('animals');
        Schema::dropIfExists('booking_requests');
        Schema::dropIfExists('control_logs');
        Schema::dropIfExists('commands');
        Schema::dropIfExists('condition_list');
        Schema::dropIfExists('sensor_logs');
        Schema::dropIfExists('devices_init');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('commands');
        Schema::dropIfExists('device_types');
        Schema::dropIfExists('home_assistant');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('attends');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_types');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('users_permits');
        Schema::dropIfExists('users_roles');
        Schema::dropIfExists('configurations');
        Schema::dropIfExists('users');
    }
}
