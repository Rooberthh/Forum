<?php

namespace App\Http\Controllers\admin;

use App\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelsController extends Controller
{
    public function index()
    {
        $channels = Channel::with('threads')->get();

        return view('admin.channels.index', compact('channels'));
    }

    public function store()
    {
        Request()->validate([
            'name' => 'required|unique:channels',
            'description' => 'required',
            'color' => 'required'
        ]);

        $channel = Channel::create([
            'name' => request('name'),
            'description' => request('description'),
            'color' => request('color')
        ]);

        if(request()->wantsJson())
        {
            return response($channel, 200);
        }

        return redirect(route('admin.channels.index'))
            ->with('flash', 'Your channel have been created');
    }

    public function update(Channel $channel)
    {
        Request()->validate([
            'name' => 'unique:channels',
            'description' => 'required',
            'color' => 'required'
        ]);

        $channel->update([
            'name' => request('name'),
            'description' => request('description'),
            'color' => request('color')
        ]);

        if(request()->wantsJson())
        {
            return response($channel, 200);
        }

        return redirect(route('admin.channels.index'))
            ->with('flash', 'Channel have been updated');
    }
}
