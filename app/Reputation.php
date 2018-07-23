<?php

namespace App;


class Reputation
{
    const THREAD_WAS_PUBLISHED = 10;
    const REPLY_WAS_POSTED = 2;
    const REPLY_WAS_MARKED_AS_BEST = 50;
    const REPLY_FAVORITED = 5;

    public static function award(User $user, $points)
    {
        $user->increment('reputation', $points);
    }

    public static function deduct(User $user, $points)
    {
        $user->decrement('reputation', $points);
    }
}
