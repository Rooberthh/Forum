<?php

namespace Tests\Feature\roles\moderator;

use App\Channel;
use App\Thread;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuperAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    function an_superAdmin_can_access_their_dashboard()
    {
        $this->signInDeveloper();

        $this->get(route('superAdmin.dashboard.index'))
            ->assertStatus(200);
    }


}
