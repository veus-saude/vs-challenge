<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Lucas Maia',
            'email' => 'lucas.codemax@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('himura08')
        ]);
    }
}
