<?php
/**
 * Created by PhpStorm.
 * User: Roberth
 * Date: 7/6/2018
 * Time: 9:19 AM
 */

namespace App;


use Illuminate\Support\Facades\Redis;

class Trending
{
    public function get()
    {
        return array_map('json_decode' ,Redis::zrevrange($this->cacheKey(), 0, 4));
    }

    public function push($thread)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $thread->title,
            'path' => $thread->path()
        ]));
    }

    public function cacheKey()
    {
        return app()->environment('testing') ? 'testing_trending_threads' : 'trending_threads';
    }

    public function reset()
    {
        return Redis::del($this->cacheKey());
    }

    public function remove($thread)
    {
        Redis::zrem($this->cacheKey(), json_encode([
            'title' => $thread->title,
            'path' => $thread->path()
        ]));
    }

}
