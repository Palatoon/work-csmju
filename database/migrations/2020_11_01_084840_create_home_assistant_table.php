<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeAssistantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_assistant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('ip')->nullable();
            $table->string('port')->nullable();
            $table->string('token')->nullable();
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
        if (Schema::hasTable('device_type_statuses')) {
            Schema::table('devices', function (Blueprint $table) {
                $table->dropForeign('devices_home_assistant_id_foreign'); //this is the line
                $table->dropIndex('devices_home_assistant_id_index');
                $table->dropColumn('home_assistant_id');
            });
            Schema::dropIfExists('home_assistant');
        }
    }
}
