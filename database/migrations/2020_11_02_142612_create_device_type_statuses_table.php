<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTypeStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_type_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('device_type_id')->nullable();
            $table->foreign('device_type_id')->references('id')->on('device_types');
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('icon_color')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('device_type_statuses');
    }
}
