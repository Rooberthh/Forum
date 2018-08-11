<?php

namespace App\Http\Controllers\api;

use App\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepliesController extends Controller
{
    public function index(){
        return Reply::all();
    }
}
