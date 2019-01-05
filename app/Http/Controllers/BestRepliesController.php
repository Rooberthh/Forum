<?php

namespace App\Http\Controllers;

use App\Reply;

class BestRepliesController extends Controller
{
    public function store(Reply $reply)
    {
        if(auth()->user()->hasPermissionTo('moderate') || $this->authorize('update', $reply->thread)) {
            $reply->thread->markBestReply($reply);
        }
    }
}
