<?php

namespace App\Listeners;

use Auth;

class JwtEventListener
{
    public function subscribe($events)
    {
        $events->listen('tymon.jwt.valid', function ($user) {
            Auth::setUser($user);
        });
    }
}