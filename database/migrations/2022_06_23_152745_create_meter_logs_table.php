<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeterLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DataLog', function (Blueprint $table) {
            $table->bigIncrements('RowID');
            $table->unsignedBigInteger('SensorID')->nullable();
            $table->foreign('SensorID')->references('SensorID')->on('SensorLists');
            $table->string('DataCode');
            $table->decimal('Value');
            $table->datetime('Timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DataLog');
    }
}
