<?php

use Illuminate\Database\Seeder;

class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([

            "name" => "Password Client",
            "id" => "2",
            "secret" => "LmYsP4O2KdUQuMb0aMUagx5sPwHmQHwKCRD6VjGY",
            "revoked" => 0,
            "redirect" => 'localhost',
            "password_client" => 1,
            "personal_access_client" => 0

        ]);
    }
}
