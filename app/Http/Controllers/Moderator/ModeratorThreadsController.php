<?php

namespace App\Http\Controllers\Moderator;

use App\Channel;
use App\Http\Controllers\Controller;
use App\Thread;
use App\Trending;
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

    public function destroy($channel, Thread $thread, Trending $trending)
    {
        $trending->remove($thread);

        $thread->delete();

        return redirect(route('moderator.threads.index'))->with('flash', 'Thread Deleted');
    }

    public function edit(Thread $thread)
    {
        return view('moderator.threads.edit', compact('thread'));
    }

    public function update($channel, Thread $thread)
    {

        $thread->update([
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id')
        ]);

        return back()->with('flash', 'Thread have been updated');
    }
}
