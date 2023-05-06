<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Attendees', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->unsignedBigInteger('QR_ID')->nullable();
            $table->foreign('QR_ID')->references('id')->on('QR');
            $table->string('Member_Key')->nullable();
            $table->string('Menber_NO')->nullable();
            $table->string('Attendee_Email')->nullable();
            $table->boolean('Face');
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
        Schema::dropIfExists('Attendees');
    }
}
