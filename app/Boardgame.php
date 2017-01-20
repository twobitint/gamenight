<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Storage;

class Boardgame extends Model
{
    protected $guarded = [];

    protected $appends = ['card_image'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'boardgame_bgg_tag', 'boardgame_id', 'bgg_tag_id')->withTimestamps();
    }

    public function ranks()
    {
        return $this->hasMany('App\Rank');
    }

    public function getCardImageAttribute()
    {
        $filename = 'bgg/game-images/'.$this->attributes['id'].'.jpg';
        return Storage::disk('public')->exists($filename) ? Storage::url($filename) : '/images/generic.jpg';
    }
}
