<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->text('description')->nullable();
            $table->string('default_unit')->nullable();
            $table->boolean('is_default')->default(0);
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
            Schema::table('device_type_statuses', function (Blueprint $table) {
                $table->dropForeign('device_type_statuses_device_type_id_foreign'); //this is the line
                $table->dropIndex('device_type_statuses_device_type_id_index');
                $table->dropColumn('device_type_id');
            });
            Schema::dropIfExists('device_types');
        }
    }
}
