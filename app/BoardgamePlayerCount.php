<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardgamePlayerCount extends Model
{
    protected $table = 'bgg_recommendations';

    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo('App\Boardgame');
    }
}
