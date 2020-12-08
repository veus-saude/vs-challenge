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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@veus.com.br',
            'password' => Hash::make('123456'),
            'api_token' => 'PMAxBMu4PwEMUCHm2DgItFfozk3l4kBqSGf1suKgvUMof4M2GqrIwqbLIzlv',
            // 'api_token' => Str::random(60),
        ]);        
    }
}