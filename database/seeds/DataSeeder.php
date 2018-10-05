<?php

    use App\Channel;
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
                'color' => $channel['color']
            ]);
        });

        create('App\User', [], 10);

        factory('App\Thread', 1000)->states('from_existing_channels_and_users')->create();
    }
}
