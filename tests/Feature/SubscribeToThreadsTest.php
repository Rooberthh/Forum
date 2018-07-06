<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToThreadsTest extends TestCase
{
	use RefreshDatabase;

	/** @test **/
    public function a_user_can_subscribe_to_a_thread()
    {
    	$this->signIn();

        $thread = create('App\Thread');
        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(1, $thread->fresh()->subscriptions);
    }

    /** @test **/
    public function a_user_can_unsubscribe_to_a_thread()
    {
    	$this->signIn();

        $thread = create('App\Thread');
        $this->delete($thread->path() . '/subscriptions');

        $this->assertCount(0, $thread->subscriptions);
    }
}
