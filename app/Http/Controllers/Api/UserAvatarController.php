<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class UserAvatarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {
        $user = Auth()->user();

        request()->validate([
            'avatar' => ['required', 'image']
        ]);

        if($user->avatar_path != '/storage/' . 'avatars/default.png')
        {
            $oldAvatar = auth()->user()->avatar_path;
            $oldAvatar = substr($oldAvatar, 9);

            Storage::disk('public')->delete($oldAvatar);
        }

        $user->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return response([], 204);
    }
}
