<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permits', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permit_id');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permit_id')->references('id')->on('permits')->onDelete('cascade');

            //SETTING THE PRIMARY KEYS
            $table->primary(['role_id', 'permit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permits');
    }
}
