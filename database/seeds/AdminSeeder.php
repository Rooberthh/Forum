<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create('App\User', [
            'name' => 'Roberth',
            'email' => 'roberth.evaldsson@hotmail.com',
            'password' => bcrypt('9q7q5q3q1q'),
            'confirmed' => true
        ]);
    }
}
