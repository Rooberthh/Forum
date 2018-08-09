<?php

namespace App\Http\Controllers;

use App\Reply;

class BestRepliesController extends Controller
{
    public function store(Reply $reply)
    {
        if($this->authorize( 'update', $reply->thread) || auth()->user()->hasPermissionTo('moderate')) {
            $reply->thread->markBestReply($reply);
        }

    }
}
