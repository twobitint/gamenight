<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'provider', 'provider_id', 'name', 'avatar_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function games()
    {
        return $this->belongsToMany('App\Boardgame')->withTimestamps();
    }

    public function wishlist()
    {
        return $this->belongsToMany('App\Boardgame', 'wishlist')->withTimestamps();
    }
}
