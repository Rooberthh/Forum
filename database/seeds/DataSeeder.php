<?php

    use App\Channel;
    use App\User;
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
        collect([
            [
                'name' => 'Webdev',
                'description' => 'A channel for general Webdev questions. Use this channel if you can\'t find a more specific channel for your question.',
                'color' => '#3c40c6'
            ],
            [
                'name' => 'SelfImprovement',
                'description' => 'A channel for general SelfImprovement questions. Use this channel if you can\'t find a more specific channel for your question.',
                'color' => '#0fbcf9'
            ],
            [
                'name' => 'Meditation',
                'description' => 'This channel is for all Meditation related questions.',
                'color' => '#f53b57'
            ],
            [
                'name' => 'Programming',
                'description' => 'This channel is for all Programming related questions.',
                'color' => '#05c46b'
            ],
            [
                'name' => 'TheXEffect',
                'description' => 'This channel is for all TheXEffect related questions.',
                'color' => '#1e272e'
            ],
        ])->each(function ($channel) {
            factory(Channel::class)->create([
                'name' => $channel['name'],
                'description' => $channel['description'],
                'color' => $channel['color'],
                'slug' => $channel['name']
            ]);
        });

        collect([
            [
                'name' => 'johndoe',
                'email' => 'john@example.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'rotla1981',
                'email' => 'indy@example.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'KyloRen',
                'email' => 'kylo@example.com',
                'password' => bcrypt('password')
            ],
            [
                'name' => '121gigawatts',
                'email' => 'calvin@example.com',
                'password' => bcrypt('password')
            ],
        ])->each(function ($user) {
            factory(User::class)->create(
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt('password')
                ]
            );
        });

        factory('App\Thread', 150)->states('from_existing_channels_and_users')->create();

    }
}
