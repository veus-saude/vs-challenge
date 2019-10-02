<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = array([
            'name' => 'Veus', 'email' => 'veus@example.com', 'password' => Hash::make('secret'), 'api_token' => Str::random(60)
        ]);

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
