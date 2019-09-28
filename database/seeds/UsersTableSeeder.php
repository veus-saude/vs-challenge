<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\User::class, 1)->create();
        App\User::create([
            'name' => 'veus',
            'email' => 'veus@veus.com.br',
            'password' => '123456',
            'remember_token' => Str::random(10),
        ]);
    }
}
