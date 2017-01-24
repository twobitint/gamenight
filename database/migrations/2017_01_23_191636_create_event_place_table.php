<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_place', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_id')->unsigned();
            $table->integer('place_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('place_id')->references('id')->on('places');

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
        Schema::dropIfExists('event_place');
    }
}
