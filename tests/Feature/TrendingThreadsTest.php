<?php

namespace Tests\Feature;

use App\Trending;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrendingThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->trending = new Trending();

        $this->trending->reset();
    }

    /** @test **/
    public function it_increments_a_threads_score_each_time_it_is_read()
    {
        $this->assertEmpty($this->trending->get());
        $thread = create('App\Thread');

        $this->call('GET', $thread->path());

        $trending = $this->trending->get();

        $this->assertCount(1, $trending);
        $this->assertEquals($thread->title, $trending[0]->title);
    }

//    /** @test **/
//    public function when_a_thread_that_is_trending_is_deleted_it_is_removed_from_the_trending_list()
//    {
//        $this->signIn();
//
//        $thread = create('App\Thread', [
//                        'user_id' => auth()->id(),
//                        'title' => 'Hello there'
//                    ]);
//        $this->call('GET', $thread->path());
//
//        $trending = $this->trending->get();
//        $this->assertCount(1, $trending);
//
//        $this->call('DELETE', $thread->path());
//
//        $this->assertCount(0, $trending);
//    }

}
