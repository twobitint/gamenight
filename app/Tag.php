<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $connection = 'bgdb';
    protected $table = 'tags';

    public function games()
    {
        return $this->belongsToMany('App\Boardgame');
    }
}
