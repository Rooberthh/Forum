<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('update', $user);

        return view('profiles.settings.account', compact('user'));
    }

    public function update(User $user)
    {
        request()->validate([
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return redirect('/threads')->with('flash', 'Your account have been updated!');
    }

    public function show(User $user)
    {
        return view('profiles.settings.stats', compact('user'));
    }
}
