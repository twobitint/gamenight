<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use App\Http\Controllers\Controller;

class ProviderAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)
            ->where('provider', $provider)
            ->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'          => $user->name,
            'email'         => $user->email,
            'avatar_url'    => $user->avatar,
            'provider'      => $provider,
            'provider_id'   => $user->id
        ]);
    }
}

