<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_permits', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('permit_id');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permit_id')->references('id')->on('permits')->onDelete('cascade');
 
            //SETTING THE PRIMARY KEYS
            $table->primary(['user_id','permit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_permits');
    }
}
