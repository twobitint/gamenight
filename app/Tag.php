<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'bgg_tags';

    protected $guarded = [];

    public function games()
    {
        return $this->belongsToMany('App\Boardgame', 'boardgame_bgg_tag', 'bgg_tag_id', 'boardgame_id');
    }
}
