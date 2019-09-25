<?php

use Carbon\Carbon;
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
        DB::table('users')->insert([

            'name' => 'Veus User',
            'email' => 'usuario@veusapi.com.br',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()

        ]);
    }
}
