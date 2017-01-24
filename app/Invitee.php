<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{
    public function events()
    {
        return $this->belongsToMany('App\Event')->withTimestamps();
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }
}
