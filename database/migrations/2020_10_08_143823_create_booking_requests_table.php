<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('calendar_id')->nullable();
            $table->text('icaluid')->nullable();
            $table->string('qrcode')->unique();
            $table->unsignedBigInteger('booker')->nullable();
            $table->foreign('booker')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('room')->nullable();
            $table->foreign('room')->references('id')->on('rooms');
            $table->string('title');
            $table->datetime('start');
            $table->datetime('end');
            $table->float('hour', 10, 2)->nullable();
            $table->text('detail')->nullable();
            $table->boolean('online_meeting')->default(0);
            $table->boolean('status')->default(0)->nullable();
            $table->boolean('cancel')->default(0)->nullable();
            $table->text('reject_reason')->nullable();
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
        Schema::dropIfExists('booking_requests');
    }
}
