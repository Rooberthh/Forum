<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index(User $user)
    {
        $this->authorize('update', $user);

        $user->makeVisible('email');

        return view('profiles.settings.account', compact('user'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        request()->validate([
            'name' => [Rule::unique('users')->ignore($user->id), 'required'],
            'email' => ['email' , Rule::unique('users')->ignore($user->id), 'required'],
            'password' => ['nullable','min:6', 'confirmed', Rule::unique('users')->ignore($user->id)],
        ]);

        if(Request()->get('password') == ''){
            $user->update(request()->except('password'));
        } else {
            $user->update([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password'))
            ]);
        }

        return response([], 204);
    }

    public function show(User $user)
    {
        return view('profiles.settings.stats', compact('user'));
    }
}
