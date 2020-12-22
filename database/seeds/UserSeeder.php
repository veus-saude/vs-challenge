<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('users')->insert([
            'name' => env('APP_USER_NAME'),
            'email' => env('APP_USER_EMAIL'),
            'password' => Hash::make(env('APP_USER_PASSWORD'))
        ]);
    }
}
