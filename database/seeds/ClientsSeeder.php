<?php

use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Seed the application's database with users with 'client' role.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 100)->create();
    }
}
