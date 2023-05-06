<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->text('description')->nullable();
            $table->string('floor_plan_image')->nullable();
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();
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
                $table->dropForeign('booking_requests_building_id_foreign'); //this is the line
                $table->dropIndex('booking_requests_building_id_index');
                $table->dropColumn('building_id');
            });
            Schema::dropIfExists('buildings');
        }
    }
}
