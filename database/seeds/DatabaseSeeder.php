<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Quando usar a Database chamar a classe
        $this->call(UsersTableSeeder::class);
    }
}
