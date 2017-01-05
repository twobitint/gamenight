<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardgamePlayerCount extends Model
{
    protected $connection = 'bgdb';
    protected $table = 'players';

    public function game()
    {
        return $this->belongsTo('App\Boardgame');
    }
}
