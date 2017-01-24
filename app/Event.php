<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    public function games()
    {
        return $this->belongsToMany('App\Boardgame')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

    public function places()
    {
        return $this->belongsToMany('App\Place')->withTimestamps();
    }

    public function invitees()
    {
        return $this->belongsToMany('App\Invitee')->withTimestamps();
    }
}
