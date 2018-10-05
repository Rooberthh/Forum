<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create('App\Channel', [], 10);
        create('App\User', [], 10);

        factory('App\Thread', 1000)->states('from_existing_channels_and_users')->create();
    }
}
