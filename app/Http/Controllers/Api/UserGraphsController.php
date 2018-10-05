<?php

namespace App\Http\Controllers\api;

use App\Thread;
use App\Http\Controllers\Controller;

class UserGraphsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $threads = Thread::ThisYear()->where([
            ['user_id', '=', $user->id,]
        ])->selectRaw('MONTH(created_at) as month, count(id) as threads')
            ->groupBy('month')
            ->pluck('threads', 'month');

        return $threads;
    }

}
