<?php

namespace App\Http\Controllers\moderator;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);

        return view('moderator.users.index', compact('users'));
    }
}
