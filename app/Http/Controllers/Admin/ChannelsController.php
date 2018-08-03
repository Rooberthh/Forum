<?php

namespace App\Http\Controllers\admin;

use App\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::withArchived()->with('threads')->get();

        return view('admin.channels.index', compact('channels'));
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

        return redirect(route('admin.channels.index'))
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

        return redirect(route('admin.channels.index'))
            ->with('flash', 'Channel have been updated');
    }

    public function create()
    {
        return view('admin.channels.create');
    }

    public function edit(Channel $channel)
    {
        return view('admin.channels.edit', compact('channel'));
    }

    public function destroy(Channel $channel)
    {
        $channel->delete();

        cache()->forget('channels');

        if(request()->wantsJson())
        {
            return response([], 200);
        }

        return redirect(route('admin.channels.index'))
            ->with('flash', 'Channel deleted');
    }
}
