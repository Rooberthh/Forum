<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->withExceptionHandling();
        $this->signIn();
    }

    /** @test */
    function a_thread_can_only_be_updated_by_the_owner()
    {
        $thread = create('App\Thread', ['user_id' => create('App\User')->id]);
        $this->patch($thread->path(), [])
            ->assertStatus(403);
    }

    /** @test */
    function a_thread_required_a_title_and_a_body_to_be_updated()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Is changed'
        ])->assertSessionHasErrors('body');

        $this->patch($thread->path(), [
            'body' => 'Is changed'
        ])->assertSessionHasErrors('title');
    }

    /** @test */
    function a_thread_can_be_updated_by_its_creator()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Is changed',
            'body' => 'Is changed'
        ]);
        $this->assertEquals('Is changed', $thread->fresh()->title);
    }
}
