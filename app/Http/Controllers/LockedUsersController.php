<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LockedUsersController extends Controller
{
    public function store($id)
    {
        $user = User::findOrFail($id);
        $user->update(['locked' => true]);

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->update(['locked' => false]);

        return back()->with('flash', 'User have been unlocked');
    }
}
