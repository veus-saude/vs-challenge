<?php

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
        DB::table('users')->insert([
            'name' => 'Veus Admin',
            'email' => 'master@veus.com.br',
            'password' => app('hash')->make('12345'),
        ]);
    }
}
