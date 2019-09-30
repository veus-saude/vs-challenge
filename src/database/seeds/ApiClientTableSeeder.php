<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApiClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([

            //

        ]);
    }
}
