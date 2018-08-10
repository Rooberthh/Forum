<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddAvatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_members_can_add_avatars()
    {
        $this->withExceptionHandling();

        $this->json('POST', '/api/users/1/avatar')
            ->assertStatus(401);
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $this->withExceptionHandling()->signIn();

        $this->json('POST', '/api/users/' . auth()->id() . '/avatar', [
            'avatar' => 'not-an-image'
        ])->assertStatus(422);
    }

    /** @test */
    public function a_user_may_add_an_avatar_to_their_profile()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('POST', '/api/users/' . auth()->id() . '/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertEquals('/storage/avatars/' . $file->hashName(), auth()->user()->avatar_path);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());

        return back();
    }

    /** @test */
    public function old_avatar_gets_deleted_when_a_user_updates_it()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('POST', '/api/users/' . auth()->id() . '/avatar', [
            'avatar' => $oldFile = UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertEquals('/storage/avatars/' . $oldFile->hashName(), auth()->user()->avatar_path);
        Storage::disk('public')->assertExists('avatars/' . $oldFile->hashName());


        $this->json('POST', '/api/users/' . auth()->id() . '/avatar', [
            'avatar' => $newFile = UploadedFile::fake()->image('newAvatar.jpg')
        ]);

        Storage::disk('public')->assertMissing('avatars/' . $oldFile->hashName());

        Storage::disk('public')->assertExists('avatars/' . $newFile->hashName());

    }

}

