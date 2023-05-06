<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyncLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sync_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('devices');
            $table->integer('syncNo');
            $table->text('description')->nullable();
            $table->integer('add_person');
            $table->integer('add_face');
            $table->integer('remove');
            $table->integer('add_person_cal');
            $table->integer('add_person_cal_face');
            $table->integer('remove_cal');
            $table->integer('update_face')->nullable();
            $table->date('sync_date')->nullable();
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
        Schema::dropIfExists('sync_log');
    }
}
