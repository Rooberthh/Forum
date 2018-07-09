<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LockThreads extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_members_can_add_avatars()
    {
        $this->withExceptionHandling();

        $this->json('POST', '/api/users/1/avatar')
            ->assertStatus(401);
    }
}

