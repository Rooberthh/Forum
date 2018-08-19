<?php

namespace App\Http\Controllers\api;

use App\Thread;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\map;

class UserGraphsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $threads = Thread::where([
            ['created_at', '>=', Carbon::now()->firstOfYear(),],
            ['user_id', '=', $user->id,],
        ])->selectRaw('MONTH(created_at) as month, count(id) as threads')
            ->groupBy('month')
            ->pluck('threads', 'month');

        return $threads;
    }

}
