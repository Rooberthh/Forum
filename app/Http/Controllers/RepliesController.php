<?php

namespace App\Http\Controllers;
use App\Inspections\Spam;
use App\Reply;
use App\Rules\SpamFree;
use App\Thread;
use Illuminate\Support\Facades\Gate;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread)
    {
        if(Gate::denies('create', new Reply))
        {
            return response(
                'You are posting to frequently.'
                , 422);
        }

        try
        {
            request()->validate([
                'body' => ['required', new SpamFree]
            ]);

            $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);
        } catch (\Exception $e) {
            return response('Sorry, your reply could not be saved at this time.', 422);
        }

        return $reply->load('owner');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

         if(request()->expectsJson()){
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }

    public function update(Reply $reply)
    {
        try
        {
            request()->validate([
                'body' => ['required', new SpamFree]
            ]);

            $reply->update(['body' => request('body')]);
        } catch (\Exception $e) {
            return response('Sorry your reply could not be updated at this time.', 422);
        }

        $this->authorize('update', $reply);

    }

}
