<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_an_owner()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }

    /** @test */
    function it_knows_if_it_was_just_published()
    {
        $reply = create('App\Reply');

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse($reply->wasJustPublished());
    }

    /** @test */
    function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = create('App\Reply', [
            'body' => '@JaneDoe , @JohnDoe'
        ]);

        $this->assertEquals(['JaneDoe', 'JohnDoe'], $reply->mentionedUsers());

    }

    /** @test */
    function it_wraps_mentioned_usernames_in_the_body_in_anchor_tags()
    {
        $reply = create('App\Reply', [
            'body' => 'Hello, @JaneDoe.'
        ]);

        $this->assertEquals(
          'Hello, <a href="/profiles/JaneDoe">@JaneDoe</a>.',
          $reply->body
        );

    }

    /** @test */
    function it_can_be_marked_as_best()
    {
        $reply = create('App\Reply');

        $this->assertFalse($reply->isBest());

        $reply->thread->update(['best_reply_id' => $reply->id ]);
        $this->assertTrue($reply->fresh()->isBest());
    }

    /** @test */
    function it_generates_correct_path_for_paginated_thread ()
    {
        $thread = create('App\Thread');

        $replies = create('App\Reply', [
            'thread_id' => $thread->id
        ], 3);

        config(['forum.pagination.perPage' => 1]);

        $this->assertEquals(
            $thread->path() . '?page=1#reply-1',
            $replies->first()->path()
        );

        $this->assertEquals(
            $thread->path() . '?page=2#reply-2',
            $replies[1]->path()
        );

        $this->assertEquals(
            $thread->path() . '?page=3#reply-3',
            $replies->last()->path()
        );

    }
}
