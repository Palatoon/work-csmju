<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_th')->nullable();
            $table->string('name_en')->nullable();
            $table->text('value')->nullable();
            $table->string('unit')->nullable();
            $table->string('unit_th')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_default')->default(0);
            $table->boolean('disable')->default(0);
            $table->boolean('notify_status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('configurations');
    }
}
