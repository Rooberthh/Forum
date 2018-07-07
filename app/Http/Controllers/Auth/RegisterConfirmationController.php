<?php

namespace App\Http\Controllers\auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterConfirmationController extends Controller
{
    public function index()
    {

        $user = User::where('confirmation_token', request('token'))
        ->first();
        if(! $user) {
            return redirect(route('threads'))->with('flash', 'Unknown Token');
        }

        $user->confirm();

        return redirect('/threads')
            ->with('flash', 'Your account has been confirmed');
    }
}
