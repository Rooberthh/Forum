<?php

namespace Tests\Unit;

use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolesTest extends TestCase
{

    /** @test */
    function it_ ()
    {
        $this->assertTrue(true);
    }
//    public function setUp()
//    {
//        parent::setUp();
//
//
//        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
//
//        $this->artisan('db:seed');
//
//    }
//
//    /** @test */
//    function a_user_can_be_a_moderator()
//    {
//        $user = create('App\User');
//
//        $user->assignRole('moderator');
//
//        $this->assertTrue($user->hasRole('moderator'));
//    }
//
//    /** @test */
//    function a_user_can_be_an_admin()
//    {
//        $user = create('App\User');
//
//        $user->assignRole('admin');
//
//        $this->assertTrue($user->hasRole('admin'));
//    }
//
//    /** @test */
//    function a_user_can_be_an_super_admin()
//    {
//        $user = create('App\User');
//
//        $user->assignRole('super admin');
//
//        $this->assertTrue($user->hasRole('super admin'));
//    }
}
