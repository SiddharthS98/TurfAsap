<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turfs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->float('price');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->string('address');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('type');
            $table->string('length');
            $table->string('width');
            $table->string('capacity');
            $table->string('footwear');
            $table->timestamps();
        });

        Schema::create('turf_facility', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turf_id')->unsigned();
            $table->foreign('turf_id')
                ->references('id')
                ->on('turfs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('facility');
            $table->string('value');
            $table->timestamps();


        });

        Schema::create('turf_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turf_id')->unsigned();
            $table->foreign('turf_id')
                ->references('id')
                ->on('turfs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('image_path');
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
        Schema::dropIfExists('turf_image');
        Schema::dropIfExists('turf_facility');
        Schema::dropIfExists('turfs');
    }
}
