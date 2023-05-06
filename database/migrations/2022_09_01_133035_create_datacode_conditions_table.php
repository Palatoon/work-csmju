<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatacodeConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datacode_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('datacode_id')->nullable();
            $table->foreign('datacode_id')->references('id')->on('DataCode');
            // $table->enum('type', ['normal', 'warning', 'danger'])->nullable();
            // $table->enum('section', ['1', '2'])->nullable();
            $table->enum('condition', ['<', '>', '<=', '>='])->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('datacode_conditions');
    }
}
