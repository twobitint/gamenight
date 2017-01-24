<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventInviteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_invitee', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_id')->unsigned();
            $table->integer('invitee_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('invitee_id')->references('id')->on('invitees');

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
        Schema::dropIfExists('event_invitee');
    }
}
