<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageCachedAtToBoardgame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boardgames', function (Blueprint $table) {
            $table->date('image_cached_at')->nullable();
            $table->index('image_cached_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boardgames', function (Blueprint $table) {
            $table->dropIndex(['image_cached_at']);
            $table->dropColumn('image_cached_at');
        });
    }
}
