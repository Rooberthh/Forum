<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_has_a_profile()
    {
        $user = create('App\User');

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    function profiles_display_all_threads_created_by_the_associated_user()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->get("/profiles/" . auth()->user()->name)
            ->assertSee($thread->title);
    }

    /** @test */
    function profile_owners_can_access_their_settings()
    {
        $this->withExceptionHandling();

        $user = create('App\User');
        $this->signIn($user);

        $this->get(route('settings.account', $user->name))
            ->assertStatus(200);
    }

    /** @test */
    function unauthorized_users_cant_access_other_peoples_profile_settings()
    {
        $this->withExceptionHandling();

        $user = create('App\User');
        $this->signIn();

        $this->get(route('settings.account', $user->name))
            ->assertStatus(403);
    }

    /** @test */
    function users_can_update_their_settings()
    {

        $user = create('App\User');
        $this->signIn($user);

        $this->patch(route('account.update', $user->id), [
            'name' => 'Roberthhhh',
            'email' => 'Some@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Roberthhhh']);
    }

}
