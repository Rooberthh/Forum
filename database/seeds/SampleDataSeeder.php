<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Reply;
use App\Thread;
use App\Channel;
use App\Activity;
use App\Favorite;
use App\ThreadSubscription;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->channels()->content();

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Seed the channels table.
     */
    protected function channels()
    {
        Channel::truncate();

        collect([
            [
                'name' => 'PHP',
                'description' => 'A channel for general PHP questions. Use this channel if you can\'t find a more specific channel for your question.',
                'color' => '#575fcf',
                'slug' => str_slug('PHP')
            ],
            [
                'name' => 'Vue',
                'description' => 'A channel for general Vue questions. Use this channel if you can\'t find a more specific channel for your question.',
                'color' => '#808e9b',
                'slug' => str_slug('Vue')
            ],
            [
                'name' => 'Laravel Mix',
                'description' => 'This channel is for all Laravel Mix related questions.',
                'color' => '#0fbcf9',
                'slug' => str_slug('Laravel Mix')
            ],
            [
                'name' => 'Eloquent',
                'description' => 'This channel is for all Laravel Eloquent related questions.',
                'color' => '#ff3f34',
                'slug' => str_slug('Eloquent')
            ],
            [
                'name' => 'Vuex',
                'description' => 'This channel is for all Vuex related questions.',
                'color' => '#ffa801',
                'slug' => str_slug('Vuex')
            ],
        ])->each(function ($channel) {
            factory(Channel::class)->create([
                'name' => $channel['name'],
                'description' => $channel['description'],
                'color' => $channel['color'],
                'slug' => $channel['slug']
            ]);
        });

        return $this;
    }

    /**
     * Seed the thread-related tables.
     */
    protected function content()
    {
        Thread::truncate();
        Reply::truncate();
        ThreadSubscription::truncate();
        Activity::truncate();
        Favorite::truncate();

        factory(Thread::class, 50)->states('from_existing_channels_and_users')->create()->each(function ($thread) {
            $this->recordActivity($thread, 'created', $thread->creator()->first()->id);
        });
    }

    /**
     * @param $model
     * @param $event_type
     * @param $user_id
     *
     * @throws ReflectionException
     */
    public function recordActivity($model, $event_type, $user_id)
    {
        $type = strtolower((new \ReflectionClass($model))->getShortName());

        $model->morphMany(\App\Activity::class, 'subject')->create([
            'user_id' => $user_id,
            'type' => "{$event_type}_{$type}"
        ]);
    }
}
