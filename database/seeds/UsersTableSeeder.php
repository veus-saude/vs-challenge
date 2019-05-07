<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
           'name' => 'Usuário de Testes',
            'email' => 'teste@gmail.com',
            // 'name' => str_random(10),
            // 'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret')
        ]);

        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => bcrypt('secret'),
        // ]);
    }
}
