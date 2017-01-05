<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boardgame extends Model
{
    protected $connection = 'bgdb';
    protected $table = 'games';

    public function playerCounts()
    {
        return $this->hasMany('App\BoardgamePlayerCount');
    }
}
