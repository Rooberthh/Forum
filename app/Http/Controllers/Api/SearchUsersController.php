<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchUsersController extends Controller
{
    public function index()
    {
        return User::all()->pluck('name');
    }
}
