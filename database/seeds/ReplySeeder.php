<?php

use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create('App\Thread', ['user_id' => 1], 10);
//        create('App\Reply', [], 10);
    }
}
