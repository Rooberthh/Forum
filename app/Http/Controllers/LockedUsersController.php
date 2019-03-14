<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LockedUsersController extends Controller
{
    public function store(User $user)
    {
        $user->update(['locked' => true]);

        return back()->with('flash', 'User have been locked');
    }

    public function destroy(User $user)
    {
        $user->update(['locked' => false]);

        return back()->with('flash', 'User have been unlocked');
    }
}
