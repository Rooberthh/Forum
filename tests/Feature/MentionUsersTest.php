<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MentionUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function mentioned_users_in_a_reply_is_notified()
    {
        $john = create('App\User', ['name' => 'JohnDoe']);
        $this->signIn($john);

        $jane = create('App\User', ['name' => 'JaneDoe']);

        $thread = create('App\Thread');

        $reply = make('App\Reply', [
            'body' => '@JaneDoe look at this.'
        ]);

        $this->json( 'post', $thread->path() . '/replies', $reply->toArray());

        $this->assertCount(1, $jane->notifications);
    }

    /** @test */
    function it_can_fetch_all_mentioned_users_starting_with_the_given_characters()
    {
        create('App\User', [
            'name' => 'Roberth'
        ]);
        create('App\User', [
            'name' => 'Roberth2'
        ]);
        create('App\User', [
            'name' => 'Frida'
        ]);

        $results = $this->json('GET', '/api/users', ['name' => 'Roberth']);

        $this->assertCount(2, $results->json());


    }

}
