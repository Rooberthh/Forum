<?php

    use App\User;
    use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

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
    }
}
