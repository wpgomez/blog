<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(App\User::class)->create([
            'name' => 'Willy Gomez',
            'email' => 'wp_gomez@hotmail.com',
            'password' => bcrypt('123'),
        ]);

        factory(App\User::class)->create([
            'name' => 'Steven Gomez',
            'email' => 'sgomeza1997@hotmail.com',
            'password' => bcrypt('123'),
        ]);

        factory(App\User::class, 3)->create();
    }
}
