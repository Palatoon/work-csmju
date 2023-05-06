<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_trans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id')->references('id')->on('template');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('devices');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('action_trans');
    }
}
