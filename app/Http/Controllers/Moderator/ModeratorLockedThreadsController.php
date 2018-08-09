<?php

namespace App\Http\Controllers\moderator;

use App\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeratorLockedThreadsController extends Controller
{
    public function store(Thread $thread)
    {
        $this->update(['locked' => true]);

        return redirect(route('moderator.threads.index'));
    }

    public function destroy(Thread $thread)
    {
        $this->update(['locked' => false]);

        return redirect(route('moderator.threads.index'));
    }
}
