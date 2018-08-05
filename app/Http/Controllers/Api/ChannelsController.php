<?php

namespace App\Http\Controllers\api;

use App\Channel;
use App\Http\Controllers\Controller;

class ChannelsController extends Controller
{
    public function index()
    {
        return cache()->rememberForever('channels', function () {
            return Channel::all();
        });
    }
}
