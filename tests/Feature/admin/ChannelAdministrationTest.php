<?php

namespace Tests\Feature\Admin;

use App\Channel;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelAdministrationTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    function an_admin_can_access_the_channel_administration_section()
    {
        $this->signInAdmin()
            ->get(route('admin.channels.index'))
            ->assertStatus(200);
    }

    /** @test */
    function an_administrator_can_create_a_new_channel()
    {
        $this->withExceptionHandling();

        $response = $this->createChannel([
            'name' => 'php',
            'description' => 'channel description',
            'color' => '#000000'
        ]);

        $this->get($response->headers->get('Location'))
            ->assertSee('php')
            ->assertSee('channel description');
    }

    /** @test */
    function an_administrator_can_edit_an_existing_channel()
    {
        $this->signInAdmin();

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
    function an_admin_can_mark_an_existing_channel_as_archived()
    {
        $this->signInAdmin();

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
    function an_administrator_can_delete_an_existing_channel()
    {
        $this->signInAdmin();

        $channel = create('App\Channel');

        create('App\Thread', [
            'channel_id' => 1,
        ], 2);

        $this->delete(route('admin.channels.destroy', $channel));

        $this->assertDatabaseMissing('channels', ['id' => $channel->id]);

        $this->assertEquals(0, Thread::count());
    }

    protected function createChannel($overrides = [])
    {
        $this->signInAdmin();

        $channel = make(Channel::class, $overrides);

        return $this->post(route('admin.channels.store'), $channel->toArray());
    }
}
