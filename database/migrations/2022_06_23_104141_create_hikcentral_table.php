<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHikcentralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Hikcentral', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('name')->nullable();
            $table->string('ip')->nullable();
            $table->string('appKey')->nullable();
            $table->string('appsecret')->nullable();
            $table->datetime('sync_date')->nullable();
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
        Schema::dropIfExists('Hikcentral');
    }
}
