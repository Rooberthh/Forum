<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PinThreadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    function unauthenticated_users_cant_pin_a_thread()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $thread = create('App\Thread');

        $this->post(route('pinned-threads.store', $thread))
            ->assertStatus(403);
    }

    /** @test */
    function unauthenticated_users_cant_unpin_a_thread()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $thread = create('App\Thread');

        $this->post(route('pinned-threads.destroy', $thread))
            ->assertStatus(403);
    }
    /*********    Bugged test   ************/
    /** @test */
//    function pinned_threads_are_listed_first()
//    {
//
//        $threads = create('App\Thread', [], 3);
//        $ids = $threads->pluck('id');
//
//        $this->signInModerator();
//
//        $response = $this->getJson(route('threads'));
//        $response->assertJson([
//            'data' => [
//                ['id' => $ids[0]],
//                ['id' => $ids[1]],
//                ['id' => $ids[2]]
//            ]
//        ]);
//
//        $this->post(route('pinned-threads.store', $threads->last()));
//
//        $response = $this->getJson(route('threads'));
//        $response->assertJson([
//            'data' => [
//                ['id' => $ids[2]],
//                ['id' => $ids[0]],
//                ['id' => $ids[1]]
//            ]
//        ]);
//    }

}
