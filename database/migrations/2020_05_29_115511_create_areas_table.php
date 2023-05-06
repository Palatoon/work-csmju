<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->string('floor_plan_image')->nullable();
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->boolean('disable')->default(0);
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();
            $table->enum('display_status', ['always', 'hover', 'hide'])->default('hover');
            $table->boolean("visible")->default(1)->nullable();
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
                $table->dropForeign('booking_requests_area_id_foreign'); //this is the line
                $table->dropIndex('booking_requests_area_id_index');
                $table->dropColumn('area_id');
            });
            Schema::dropIfExists('areas');
        }
    }
}
