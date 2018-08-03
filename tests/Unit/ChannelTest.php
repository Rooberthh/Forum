<?php

namespace Tests\Feature;

use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_channel_consists_of_threads()
    {
        $channel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $channel->id]);

        $this->assertTrue($channel->threads->contains($thread));
    }

    /** @test */
    public function a_channel_can_be_archived()
    {
        $channel = create(Channel::class);

        $this->assertFalse($channel->archived);

        $channel->archive();

        $this->assertTrue($channel->archived);
    }

    /** @test */
    public function archived_channels_are_excluded_by_default()
    {
        create('App\Channel');

        create('App\Channel', ['archived' => true]);

        $this->assertEquals(1, Channel::count());
    }

    /** @test */
    function archived_channels_does_not_affect_the_thread_path()
    {
        $this->signInAdmin();

        $channel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $channel->id]);
        $path = $thread->path();

        $channel->archive();

        $this->assertEquals($path, $thread->fresh()->path());
    }
}
