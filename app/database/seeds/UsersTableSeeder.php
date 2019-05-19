<?php

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
            'name' => 'Felipe Lacerda',
            'email' => 'lipe.lacerda@gmail.com.br',
            'password' => bcrypt('asdasd'), 
        ]);
    }
}
