<?php

namespace Tests\Unit;

use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed');

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    function a_user_can_be_a_moderator()
    {
        $user = create('App\User');

        $user->assignRole('Moderator');

        $this->assertTrue($user->hasRole('Moderator'));
    }

    /** @test */
    function a_user_can_be_an_admin()
    {
        $user = create('App\User');

        $user->assignRole('Admin');

        $this->assertTrue($user->hasRole('Admin'));
    }

    /** @test */
    function a_user_can_be_a_developer()
    {
        $user = create('App\User');

        $user->assignRole('Developer');

        $this->assertTrue($user->hasRole('Developer'));
    }
}
