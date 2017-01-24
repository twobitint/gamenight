<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupInviteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_invitee', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('invitee_id')->unsigned();
            $table->integer('group_id')->unsigned();

            $table->foreign('invitee_id')->references('id')->on('invitees');
            $table->foreign('group_id')->references('id')->on('groups');

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
        Schema::dropIfExists('group_invitee');
    }
}
