<?php

namespace App\Http\Controllers\moderator;

use App\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::withArchived()->with('threads')->get();

        return view('moderator.channels.index', compact('channels'));
    }

    public function store()
    {
        Request()->validate([
            'name' => 'required|unique:channels',
            'description' => 'required',
            'color' => 'required'
        ]);

        cache()->forget('channels');

        $channel = Channel::create([
            'name' => request('name'),
            'description' => request('description'),
            'color' => request('color')
        ]);

        if (request()->wantsJson()) {
            return response($channel, 201);
        }

        return redirect(route('moderator.channels.index'))
            ->with('flash', 'Your channel have been created');
    }

    public function update(Channel $channel)
    {
        Request()->validate([
            'name' => ['required', Rule::unique('channels')->ignore($channel->id)],
            'description' => 'required',
            'color' => 'required',
            'archived' => 'required|boolean'
        ]);

        $channel->update([
            'name' => request('name'),
            'description' => request('description'),
            'color' => request('color'),
            'archived' => request('archived')
        ]);

        cache()->forget('channels');

        if(request()->wantsJson())
        {
            return response($channel, 200);
        }

        return redirect(route('moderator.channels.index'))
            ->with('flash', 'Channel have been updated');
    }

    public function create()
    {
        return view('moderator.channels.create');
    }

    public function edit(Channel $channel)
    {
        return view('moderator.channels.edit', compact('channel'));
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();

        cache()->forget('channels');

        if(request()->wantsJson())
        {
            return response([], 200);
        }

        return redirect(route('moderator.channels.index'))
            ->with('flash', 'Channel deleted');
    }
}
