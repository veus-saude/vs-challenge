<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('users')->insert([
    //         'name' => 'Bruno',
    //         'email' => 'brunowolly@gmail.com',
    //         'password' => bcrypt('senha123'),
    //     ]);

    // }

    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        //$this->call(ProductTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Bruno',
            'email' => 'brunowolly@gmail.com',
            'password' => bcrypt('senha123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'name' => 'SERINGA 1 ML',
            'price' => 0.99,
            'amount' => 10,
            'brand' => 'BUNZL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('products')->insert([
            'name' => 'SERINGA 3 ML',
            'price' => 1.29,
            'amount' => 10,
            'brand' => 'BUNZL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('products')->insert([
            'name' => 'SERINGA 5 ML',
            'price' => 1.69,
            'amount' => 8,
            'brand' => 'BUNZL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'name' => 'GAZE COMUM',
            'price' => 1.44,
            'amount' => 3,
            'brand' => 'BUNZL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'name' => 'GAZE GOLD',
            'price' => 2.44,
            'amount' => 5,
            'brand' => 'BUNZL',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'name' => 'SORO FISIOLOGICO 500 ML',
            'price' => 2.67,
            'amount' => 8,
            'brand' => 'B. BRAUN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'name' => 'BOMBA DE INFUSÃO ',
            'price' => 1453.67,
            'amount' =>2,
            'brand' => 'B. BRAUN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
