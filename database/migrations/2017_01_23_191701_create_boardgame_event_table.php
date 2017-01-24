<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardgameEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardgame_event', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_id')->unsigned();
            $table->integer('boardgame_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('boardgame_id')->references('id')->on('boardgames');

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
        Schema::dropIfExists('boardgame_event');
    }
}
