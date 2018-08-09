<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Thread;
use Illuminate\Http\Request;

class ModeratorThreadsController extends Controller
{
    public function index()
    {
        $threads = Thread::all();

        return view('moderator.threads.index', [
            'threads' => $threads
        ]);
    }
}
