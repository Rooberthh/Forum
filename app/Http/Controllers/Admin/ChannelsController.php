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
}
