<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BestReplyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    public function a_thread_creator_may_mark_any_reply_as_the_best_reply()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $replies = create('App\Reply', [ 'thread_id' => $thread->id], 2);

        $this->assertFalse($replies[1]->isBest());

        $this->postJson(route('best-replies.store', [$replies[1]->id]));

        $this->assertTrue($replies[1]->fresh()->isBest());
    }

    /** @test */
    function only_the_thread_creator_may_mark_a_reply_as_best()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $thread = create('App\Thread', [ 'user_id' => auth()->id()]);
        $replies = create('App\Reply', [ 'thread_id' => $thread->id], 2);

        $this->signIn(create('App\User'));
        $this->postJson(route('best-replies.store', [$replies[1]->id]));

        $this->assertFalse($replies[1]->fresh()->isBest());
    }
    //--------------------------------
    //  Works when run as stand alone test, SQLite error
    //--------------------------------
//    /** @test */
//    function if_a_best_reply_is_deleted_then_the_thread_is_properly_updated()
//    {
//        DB::statement('PRAGMA foreign_keys=on');
//
//        $this->signIn();
//
//        $reply = create('App\Reply', [ 'user_id' => auth()->id()]);
//
//        $reply->thread->markBestReply($reply);
//
//        $this->deleteJson(route('replies.destroy', $reply));
//
//        $this->assertNull($reply->thread->fresh()->best_reply_id);
//    }

}

