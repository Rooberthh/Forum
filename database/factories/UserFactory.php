<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function ($faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'confirmed' => true
    ];
});

$factory->state(App\User::class, 'unconfirmed', function(){
   return [
       'confirmed' => false
   ];
});

$factory->define(App\Thread::class, function ($faker) {
    $title = $faker->sentence;
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'channel_id' => function () {
            return factory('App\Channel')->create()->id;
        },
        'title' => $title,
        'body'  => $faker->paragraph,
        'visits' => 0,
        'slug' => str_slug($title),
        'locked' => false
    ];
});
$factory->state(App\Thread::class, 'from_existing_channels_and_users', function ($faker) {
    $title = $faker->sentence;

    return [
        'user_id' => function () {
            return \App\User::all()->random()->id;
        },
        'channel_id' => function () {
            return \App\Channel::all()->random()->id;
        },
        'title' => $title,
        'body'  => $faker->paragraph,
        'visits' => $faker->numberBetween(0, 35),
        'slug' => str_slug($title),
        'locked' => $faker->boolean(false)
    ];
});

$factory->define(App\Channel::class, function ($faker) {
    $name = $faker->unique()->word;

    return [
        'name' => $name,
        'slug' => $name,
        'description' => $faker->sentence,
        'archived' => false
    ];
});

$factory->state(App\Reply::class, 'from_existing_threads_and_users', function ($faker) {
    return [
        'thread_id' => function () {
            return \App\Thread::all()->random()->id;
        },
        'user_id' => function () {
            return \App\User::all()->random()->id;
        },
        'body'  => $faker->paragraph
    ];
});

    $factory->define(App\Reply::class, function ($faker) {
        return [
            'thread_id' => function () {
                return factory('App\Thread')->create()->id;
            },
            'user_id' => function () {
                return factory('App\User')->create()->id;
            },
            'body'  => $faker->paragraph
        ];
    });

$factory->define(\Illuminate\Notifications\DatabaseNotification::class, function ($faker) {
    return [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'type' => 'App\Notifications\ThreadWasUpdated',
        'notifiable_id' => function () {
            return auth()->id() ?: factory('App\User')->create()->id;
        },
        'notifiable_type' => 'App\User',
        'data' => ['foo' => 'bar']
    ];
});
