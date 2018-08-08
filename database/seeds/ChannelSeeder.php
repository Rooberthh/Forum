<?php

use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create('App\Channel', [
            'name' => 'admin',
            'slug' => 'admin',
            'description' => 'Admin Channel'
        ]);

        create('App\Channel', [
            'name' => 'moderator',
            'slug' => 'moderator',
            'description' => 'Moderator Channel'
        ]);
    }
}
