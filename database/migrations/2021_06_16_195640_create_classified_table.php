<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifiedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classified', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_membreship')->unsigned();
            $table->foreign('id_user_membreship')->references('id')->on('user_membreships');
            $table->bigInteger('id_user_sponsor')->unsigned();
            $table->foreign('id_user_sponsor')->references('id')->on('user_membreships');
            $table->string('binary_sponsor', 50);
            $table->string('position', 2);
            $table->integer('classification')->default('1');
            $table->string('status', 1)->default('0');
            $table->string('authorized', 1)->default('1');
            $table->string('status_position_left', 1)->default('0');
            $table->string('status_position_right', 1)->default('0');
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
        Schema::dropIfExists('classified');
    }
}
