<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomationTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automation_trans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('automation_id')->nullable();
            $table->foreign('automation_id')->references('id')->on('automation');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id')->references('id')->on('template');
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
        Schema::dropIfExists('automation_trans');
    }
}
