<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'bgg_ranks';

    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo('App\Boardgame');
    }
}
