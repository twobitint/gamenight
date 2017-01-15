<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBggRanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgg_ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->string('pretty_name');
            $table->integer('bgg_id');
            $table->decimal('bayes_average', 7, 5);
            $table->integer('rank');
            $table->integer('boardgame_id')->unsigned();
            $table->timestamps();

            $table->foreign('boardgame_id')->references('id')->on('boardgames');

            $table->unique(['boardgame_id', 'type', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
