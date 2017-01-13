<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardgamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardgames', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('thumbnail');
            $table->string('image');
            $table->text('description');
            $table->string('year');
            $table->integer('min_players');
            $table->integer('max_players');
            $table->integer('min_playtime');
            $table->integer('max_playtime');
            $table->integer('playtime');
            $table->integer('users_rated');
            $table->decimal('rating_average', 7, 5);
            $table->decimal('rating_bayes', 7, 5);
            $table->decimal('stddev', 7, 5);
            $table->integer('rank')->nullable();
            $table->integer('weight_count');
            $table->decimal('weight_average', 7, 5);
            $table->timestamps();

            $table->primary('id');
            $table->index('rank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boardgames');
    }
}
