<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->text('detail');
            $table->unsignedBigInteger('animal_id')->nullable();
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->unsignedBigInteger('history_types_id')->nullable();
            $table->foreign('history_types_id')->references('id')->on('history_types');
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
        Schema::dropIfExists('animal_history');
    }
}
