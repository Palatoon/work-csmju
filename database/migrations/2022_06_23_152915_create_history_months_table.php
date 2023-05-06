<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('History_Months', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->unsignedBigInteger('SensorID')->nullable();
            $table->foreign('SensorID')->references('SensorID')->on('SensorLists');
            $table->string('DataCode');
            $table->decimal('Value');
            $table->decimal('Price')->nullable();
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
        Schema::dropIfExists('History_Months');
    }
}
