<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\Roles;

class DatabaseTestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('secret'),
                'role' => Roles::ADMINISTRATOR,
            ],
            [
                'name' => 'Client 1',
                'email' => 'client1@example.com',
                'password' => Hash::make('secret'),
                'role' => Roles::CLIENT,
            ],
            [
                'name' => 'Client 2',
                'email' => 'client2@example.com',
                'password' => Hash::make('secret'),
                'role' => Roles::CLIENT,
            ]
        ]);

        Product::insert([
            [
                'name' => 'Product 1',
                'brand' => 'Brand 1',
                'price' => 10.00,
                'stock' => 10,
            ],
            [
                'name' => 'Product 2',
                'brand' => 'Brand 2',
                'price' => 20.00,
                'stock' => 20,
            ],
            [
                'name' => 'Product 3',
                'brand' => 'Brand 3',
                'price' => 30.00,
                'stock' => 30,
            ]
        ]);
    }
}
