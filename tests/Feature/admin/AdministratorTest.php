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

    }

?>
