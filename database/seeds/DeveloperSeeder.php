<?php

use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = create('App\User', [
            'name' => 'Developer',
            'email' => 'developer@developer.com',
            'password' => bcrypt('password'),
            'confirmed' => true
        ]);
        $user->assignRole('Developer');

        $user = create('App\User', [
            'name' => 'Moderator',
            'email' => 'moderator@moderator.com',
            'password' => bcrypt('password'),
            'confirmed' => true
        ]);
        $user->assignRole('Moderator');

        create('App\User', [
            'name' => 'User',
            'email' => 'User@user.com',
            'password' => bcrypt('password'),
            'confirmed' => true
        ]);
    }
}
