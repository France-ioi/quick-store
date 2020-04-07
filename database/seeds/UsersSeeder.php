<?php

use Illuminate\Database\Seeder;


class UsersSeeder extends Seeder
{

    public function run()
    {
        for($i=1; $i<10; $i++) {
            \App\User::create([
                'prefix' => 'prefix'.$i,
                'password' => \Hash::make('123')
            ]);
        }
    }
}
