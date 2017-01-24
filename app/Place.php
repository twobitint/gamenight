<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function events()
    {
        return $this->belongsToMany('App\Event')->withTimestamps();
    }
}
