<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('turf_id')->unsigned();
            $table->foreign('turf_id')
                ->references('id')
                ->on('turfs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('hours');
            $table->unsignedInteger('from');
            $table->date('date');
            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')
                ->references('id')
                ->on('cards')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->float('amount');
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
        Schema::dropIfExists('bookings');
    }
}
