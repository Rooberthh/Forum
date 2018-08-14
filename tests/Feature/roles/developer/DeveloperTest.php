<?php

namespace Tests\Feature\roles\developer;

use App\Channel;
use App\Thread;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeveloperTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    function an_developer_can_access_their_dashboard()
    {
        $user = create('App\User');
        $user->assignRole('Developer');
        $this->signIn($user);

        $this->get(route('developer.dashboard.index'))
            ->assertStatus(200);
    }


}
