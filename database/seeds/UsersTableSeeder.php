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
          [
            'id' => 1,
            'name' => 'Usuario Administrador',
            'email' => 'administrador@administrador.com.br',
            'password' => bcrypt('admin123'),
            'created_at' => date(now()),
          ]
        ]);
    }
}
