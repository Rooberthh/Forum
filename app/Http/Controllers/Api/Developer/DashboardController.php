<?php

namespace App\Http\Controllers\Api\Developer;

use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function replies()
    {
        return Reply::all()->count();
    }

    public function threads()
    {
        return Thread::all()->count();
    }

    public function users()
    {
        return User::all()->count();
    }

    public function channels()
    {
        return Channel::all()->count();
    }
}
