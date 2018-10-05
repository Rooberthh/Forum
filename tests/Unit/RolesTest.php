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
    }

    /** @test */
    function a_user_can_be_a_moderator()
    {
        $user = create('App\User');

        $user->assignRole('moderator');

        $this->assertTrue($user->hasRole('moderator'));
    }

    /** @test */
    function a_user_can_be_an_admin()
    {
        $user = create('App\User');

        $user->assignRole('admin');

        $this->assertTrue($user->hasRole('admin'));
    }

    /** @test */
    function a_user_can_be_a_developer()
    {
        $user = create('App\User');

        $user->assignRole('developer');

        $this->assertTrue($user->hasRole('developer'));
    }
}
