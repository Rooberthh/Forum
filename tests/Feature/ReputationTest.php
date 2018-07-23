<?php

namespace Tests\Feature;

use App\Reputation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReputationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_earns_points_on_thread_create()
    {
        $thread = create('App\Thread');
        $this->assertEquals(Reputation::THREAD_WAS_PUBLISHED, $thread->creator->reputation);
    }

    /** @test */
    public function a_user_lose_points_on_thread_deletion()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->delete($thread->path());

        $this->assertEquals(0, $thread->creator->fresh()->reputation);
    }

    /** @test */
    public function a_user_earns_points_on_reply_create()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = $thread->addReply([
           'user_id' => auth()->id(),
            'body' => 'Lit reply'
        ]);

        $this->assertEquals(Reputation::REPLY_WAS_POSTED, $reply->owner->reputation);
    }

    /** @test */
    public function a_user_earn_points_when_their_reply_is_favorited()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some body'
        ]);

        $this->post("replies/{$reply->id}/favorites");

        $points = Reputation::REPLY_WAS_POSTED + Reputation::REPLY_FAVORITED;

        $this->assertEquals($points, $reply->owner->fresh()->reputation);
    }

    /** @test */
    public function a_user_lose_points_when_their_favorited_reply_is_unfavorited()
    {
        $this->signIn();

        $reply = create('App\Reply', [
            'user_id' => auth()->id()
        ]);

        $this->post("replies/{$reply->id}/favorites");

        $points = Reputation::REPLY_WAS_POSTED + Reputation::REPLY_FAVORITED;
        $this->assertEquals( $points, $reply->owner->fresh()->reputation);


        $this->delete("replies/{$reply->id}/favorites");
        $points = Reputation::REPLY_WAS_POSTED + Reputation::REPLY_FAVORITED - Reputation::REPLY_FAVORITED;

        $this->assertEquals($points, $reply->owner->fresh()->reputation);
    }

    /** @test */
    public function a_user_lose_points_when_they_delete_their_reply()
    {
        $this->signIn();

        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $this->delete("/replies/{$reply->id}");

        $this->assertEquals(0, $reply->owner->fresh()->reputation);
    }

    /** @test */
    public function a_user_earns_points_when_their_reply_is_marked_as_best()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $reply = $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Lit reply'
        ]);

        $thread->markBestReply($reply);

        $points = Reputation::REPLY_WAS_POSTED + Reputation::REPLY_WAS_MARKED_AS_BEST;
        $this->assertEquals($points, $reply->owner->reputation);
    }

    /** @test */
    public function a_user_lose_points_when_their_best_reply_is_deleted()
    {
        $this->signIn();

        $reply = create('App\Reply', ['user_id' => auth()->id()] );

        $reply->thread->markBestReply($reply);
        $reply->delete();

        $this->assertEquals(0, auth()->user()->fresh()->reputation);
    }
}
