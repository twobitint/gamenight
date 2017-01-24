<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function events()
    {
        return $this->belongsToMany('App\Event')->withTimestamps();
    }

    public function invitees()
    {
        return $this->belongsToMany('App\Invitee')->withTimestamps();
    }
}
