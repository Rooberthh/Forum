<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
	use RefreshDatabase;

    /** @test **/
    public function a_notification_is_prepeared_when_a_subscribed_thread_recieves_a_new_reply_that_is_not_by_the_current_user()
    {
    	$this->signIn();

    	$thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
        	'user_id' => auth()->id(),
        	'body' => 'Some reply'
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply([
        	'user_id' => create('App\User')->id,
        	'body' => 'Some reply'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test **/
    function a_user_fetch_their_undread_notifications()
    {
    	$this->signIn();

    	$thread = create('App\Thread')->subscribe();

    	$user = auth()->user();

    	$thread->addReply([
        	'user_id' => create('App\User')->id,
        	'body' => 'Some reply'
        ]);

        $response = $this->getJson("/profiles/" . $user->name . "/notifications")->json();

        $this->assertCount(1, $response);
    }

    /** @test **/
    function a_user_can_mark_a_notification_as_read()
    {
    	$this->signIn();

    	$thread = create('App\Thread')->subscribe();

    	$thread->addReply([
        	'user_id' => create('App\User')->id,
        	'body' => 'Some reply'
        ]);

        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $notificationId = $user->unreadNotifications->first()->id;

        $this->delete("/profiles/" . $user->name . "/notifications/{$notificationId}");

        $this->assertCount(0, $user->fresh()->unreadNotifications);
    }
}
