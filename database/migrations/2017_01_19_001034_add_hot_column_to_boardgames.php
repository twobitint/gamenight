<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHotColumnToBoardgames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boardgames', function (Blueprint $table) {
            $table->date('hot_at')->nullable();
            $table->index('hot_at');
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
            $table->dropIndex(['hot_at']);
            $table->dropColumn('hot_at');
        });
    }
}
