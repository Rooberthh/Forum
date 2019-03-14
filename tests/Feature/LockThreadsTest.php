<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LockThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {

        parent::setUp();

        $this->artisan('db:seed');

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();

    }


    /** @test */
    public function once_locked_a_thread_may_not_receive_new_replies()
    {
        $this->signIn();

        $thread = create('App\Thread', ['locked' => true]);

        $this->post($thread->path() . '/replies', [
            'body' => 'Foobar',
            'user_id' => create('App\User')->id
        ])->assertStatus(422);
    }

    /** @test */
    public function a_moderator_can_reply_to_locked_threads()
    {
        $this->signInDeveloper();

        $thread = create('App\Thread', ['locked' => true]);

        $this->post($thread->path() . '/replies', [
            'body' => 'Foobar',
            'user_id' => auth()->id()
        ])->assertStatus(201);
    }
}

