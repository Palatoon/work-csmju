<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('animal_attributes_name')->nullable();
            $table->string('animal_attributes_name_en')->nullable();
            $table->string('animal_attributes_unit')->nullable();
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
        Schema::dropIfExists('animal_attributes');
    }
}
