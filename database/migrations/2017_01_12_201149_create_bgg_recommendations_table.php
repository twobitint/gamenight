<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBggRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgg_recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('boardgame_id')->unsigned();
            $table->integer('players');
            $table->boolean('or_more');
            $table->decimal('best', 7, 5);
            $table->decimal('recommended', 7, 5);
            $table->decimal('bad', 7, 5);
            $table->decimal('optimal', 7, 5);
            $table->integer('weighted');
            $table->timestamps();

            $table->foreign('boardgame_id')->references('id')->on('boardgames');

            $table->unique(['boardgame_id', 'players', 'or_more']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgg_recommendations');
    }
}
