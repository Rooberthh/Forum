<?php

namespace Tests\Feature\roles\moderator;

use App\Channel;
use App\Thread;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModeratorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    function an_moderator_can_access_their_dashboard()
    {
        $this->signInModerator();

        $this->get(route('moderator.dashboard.index'))
            ->assertStatus(200);
    }

    /** @test */
    function an_unauthenticated_user_cant_access_the_moderator_dashboard()
    {
        $this->signIn();

        $this->get(route('moderator.dashboard.index'))
            ->assertStatus(403);
    }

    /** @test */
    function an_moderator_can_edit_an_existing_thread()
    {
        $thread = create('App\Thread');

        $this->signInModerator();

        $this->patch($thread->path(), [
            'title' => 'is changed',
            'body' => 'is changed'
        ]);

        $this->assertEquals('is changed', $thread->fresh()->title);
    }
    /** @test */
    function an_moderator_can_delete_an_existing_thread()
    {
        $thread = create('App\Thread');

        $this->signInModerator();

        $this->delete($thread->path());

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
    }

    /** @test */
    function an_moderator_can_edit_an_existing_reply()
    {
        $reply = create('App\Thread');

        $this->signInModerator();

        $this->patch($reply->path(), [
            'title' => 'is changed',
            'body' => 'is changed'
        ]);

        $this->assertEquals('is changed', $reply->fresh()->title);
    }

    /** @test */
    function an_moderator_can_lock_threads()
    {
        $thread = create('App\Thread');

        $this->signInModerator();

        $this->post(route('locked-threads.store', $thread));

        $this->assertTrue($thread->fresh()->locked);
    }

    /** @test */
    function an_moderator_can_unlock_threads()
    {
        $thread = create('App\Thread');

        $this->signInModerator();

        $this->delete(route('locked-threads.destroy', $thread));

        $this->assertFalse($thread->fresh()->locked);
    }

    /** @test */
    function an_moderator_can_pin_threads()
    {
        $thread = create('App\Thread');

        $this->signInModerator();

        $this->post(route('pinned-threads.store', $thread));

        $this->assertTrue($thread->fresh()->pinned);
    }

    /** @test */
    function an_moderator_can_create_a_new_channel()
    {
        $this->signInModerator();

        $channel = make(Channel::class, [
            'name' => 'php',
            'description' => 'channel description',
            'color' => '#000000'
        ]);

        $response = $this->post(route('admin.channels.store'), $channel->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee('php')
            ->assertSee('channel description');
    }

    /** @test */
    function an_moderator_can_edit_an_existing_channel()
    {
        $this->signInModerator();

        $channel = create('App\Channel');

        $this->patch(route('admin.channels.update', $channel), [
            'name' => 'updated name',
            'description' => 'updated description',
            'color' => '#000000',
            'archived' => true
        ]);

        $this->assertEquals('updated name', $channel->fresh()->name);
    }

    /** @test */
    function an_moderator_can_mark_an_existing_channel_as_archived()
    {
        $this->signInModerator();

        $channel = create('App\Channel');

        $this->patch(route('admin.channels.update', $channel), [
            'name' => 'updated name',
            'description' => 'updated description',
            'color' => '#000000',
            'archived' => true
        ]);

        $this->assertTrue($channel->fresh()->archived);
    }

    /** @test */
    function an_moderator_can_delete_an_existing_channel()
    {
        $this->signInModerator();

        $channel = create('App\Channel');

        create('App\Thread', [
            'channel_id' => 1,
        ], 2);

        $this->delete(route('admin.channels.destroy', $channel));

        $this->assertDatabaseMissing('channels', ['id' => $channel->id]);
    }

}
