<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdministratorTest extends TestCase
    {
        use RefreshDatabase;

        /** @test */
        function an_administrator_can_access_the_administration_section()
        {
            $this->withExceptionHandling();

            $this->signInAdmin()
                ->get(route('admin.dashboard.index'))
                ->assertStatus(200);
        }

        /** @test */
        function unauthenticated_users_cant_access_the_administration_section()
        {
            $this->withExceptionHandling();

            $this->signIn();
            $this->get(route('admin.dashboard.index'))
                ->assertStatus(403);
        }

        /** @test */
        function an_administrator_can_delete_a_channel()
        {
            $this->withExceptionHandling();
            $channel = create('App\Channel');

            $this->signInAdmin();

            $this->delete(route('admin.channels.destroy', $channel))
                ->assertRedirect(route('admin.channels.index'));

            $this->assertDatabaseMissing('channels', ['id' => $channel->id]);
            $this->assertDatabaseMissing('threads', ['channel_id' => $channel->id]);
        }

        /** @test */
        function an_administrator_can_edit_a_channel()
        {
            $this->withExceptionHandling();
            $channel = create('App\Channel');

            $this->signInAdmin();

            $this->patch(route('admin.channels.update', $channel), [
                'name' => 'new channel',
                'description' => 'description',
                'color' => '#fff',
                'archived' => true
            ]);

            $this->assertEquals('new channel', $channel->fresh()->name);
        }

    }

?>
