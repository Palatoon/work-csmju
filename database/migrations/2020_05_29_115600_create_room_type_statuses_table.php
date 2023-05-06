<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypeStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_type_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_type_id')->nullable();
            $table->foreign('room_type_id')->references('id')->on('room_types');
            $table->string('name')->nullable();
            $table->string('status_image')->nullable();
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
        Schema::dropIfExists('room_type_statuses');
    }
}
