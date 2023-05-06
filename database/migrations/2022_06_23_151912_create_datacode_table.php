<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatacodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DataCode', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DataCode')->nullable();
            $table->string('DataLabel')->nullable();
            $table->string('DataUnit')->nullable();
            $table->string('SmallCode')->nullable();
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
        Schema::dropIfExists('DataCode');
    }
}
