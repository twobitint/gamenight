<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boardgame extends Model
{

    protected $guarded = [];

    // public function playerCounts()
    // {
    //     return $this->hasMany('App\BoardgamePlayerCount');
    // }
    //
    // public function tags()
    // {
    //     return $this->belongsToMany('App\Tag', 'games_tags', 'game_id');
    // }
}
