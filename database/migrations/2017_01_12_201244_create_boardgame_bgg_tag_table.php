<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardgameBggTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardgame_bgg_tag', function (Blueprint $table) {
            $table->integer('bgg_tag_id')->unsigned();
            $table->integer('boardgame_id')->unsigned();
            $table->timestamps();

            $table->foreign('bgg_tag_id')->references('id')->on('bgg_tags');
            $table->foreign('boardgame_id')->references('id')->on('boardgames');

            $table->primary(['bgg_tag_id', 'boardgame_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boardgame_bgg_tag');
    }
}
