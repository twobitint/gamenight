<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boardgame extends Model
{
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'boardgame_bgg_tag', 'boardgame_id', 'bgg_tag_id')->withTimestamps();
    }

    public function ranks()
    {
        return $this->hasMany('App\Rank');
    }
}
