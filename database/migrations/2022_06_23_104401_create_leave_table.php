<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Leave', function (Blueprint $table) {
            $table->unsignedBigInteger('Room_ID')->nullable();
            $table->foreign('Room_ID')->references('id')->on('rooms');
            $table->string('Event_ID')->nullable();
            $table->boolean('Cancelled')->default(0)->nullable();
            $table->boolean('Person')->default(0)->nullable();
            $table->datetime('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Leave');
    }
}
