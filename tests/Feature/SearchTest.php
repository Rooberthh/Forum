<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Thread;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_search_threads()
    {
        config(['scout.driver' => 'algolia']);

        $searchTerm = "Keyword";

        create('App\Thread', [], 2);
        create('App\Thread', ['title' => "Thread title with {$searchTerm}"], 2);

        do
        {
            sleep(2.5);
            $results = $this->getJson("/threads/search?q={$searchTerm}")->json();
        } while (empty($results));

        $this->assertCount(2, $results['data']);

        Thread::latest()->take(4)->unsearchable();
    }
}
