<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePostRequest;
use App\Reply;
use App\Rules\SpamFree;
use App\Thread;

class RepliesController extends Controller
{
    /**
     * Create a new RepliesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(10);
    }

    /**
     * Persist a new reply.
     *
     * @param  integer $channelId
     * @param  Thread $thread
     * @param CreatePostRequest $form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread, CreatePostRequest $form)
    {
        if($thread->locked)
        {
            return response('Thread is locked',422);
        }

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return $reply->load('owner');
    }

    public function destroy(Reply $reply)
    {
        if(auth()->user()->can('delete-reply') || $this->authorize('update', $reply))
        {
            $reply->delete();

            if(request()->expectsJson()){
                return response(['status' => 'Reply deleted']);
            }

            return back();
        }

    }

    public function update(Reply $reply)
    {
        if(auth()->user()->can('edit-reply') ||$this->authorize('update', $reply))
        {
            request()->validate([
                'body' => ['required', new SpamFree]
            ]);

            $reply->update(['body' => request('body')]);
        }
    }

}
