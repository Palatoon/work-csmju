<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QR', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->unsignedBigInteger('Req_ID')->nullable();
            $table->foreign('Req_ID')->references('id')->on('booking_requests')->onDelete('cascade');
            $table->string('Room_Email')->nullable();
            $table->text('Event_ID')->nullable();
            $table->string('QR_Code')->nullable();
            $table->string('Organizer')->nullable();
            $table->string('Template_ID')->nullable();
            $table->boolean('Access_Status')->default(0);
            $table->boolean('Leave_Status')->default(0)->nullable();
            $table->datetime('Booking_DateTime');
            $table->datetime('End_Datetime');
            $table->string('Subject')->nullable();
            $table->text('Detail')->nullable();
            $table->boolean('Online_Meeting')->nullable();
            $table->datetime('create_date');
            $table->datetime('update_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('QR');
    }
}
