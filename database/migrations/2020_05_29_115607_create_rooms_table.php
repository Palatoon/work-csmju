<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('email')->nullable();
            $table->integer('seat')->nullable();
            $table->text('description')->nullable();
            $table->string('floor_plan_image')->nullable();
            $table->unsignedBigInteger('room_type_id')->nullable();
            $table->foreign('room_type_id')->references('id')->on('room_types');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->boolean('auto_approve')->default(0);
            $table->unsignedBigInteger('approver')->nullable();
            $table->foreign('approver')->references('id')->on('users');
            $table->boolean('disable')->default(0);
            $table->enum('display_status', ['always', 'hover', 'hide'])->default('hover');
            $table->boolean("visible")->default(1)->nullable();
            $table->boolean('active_license')->nullable();
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();
            $table->softDeletes();
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
        if (Schema::hasTable('booking_requests')) {
            Schema::table('booking_requests', function (Blueprint $table) {
                $table->dropForeign('booking_requests_room_id_foreign'); //this is the line
                $table->dropIndex('booking_requests_room_id_index');
                $table->dropColumn('room_id');
            });
            Schema::dropIfExists('rooms');
        }
    }
}
