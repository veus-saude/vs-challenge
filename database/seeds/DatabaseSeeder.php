<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 10)->create();
        DB::table('users')->delete();

        $users = array([
            'name' => 'Veus', 'email' => 'veus@example.com', 'password' => Hash::make('secret'), 'api_token' => 'DoYvonEze6WXMdBTEQRis2VxZufSxEFuDvJDouiPnJrwKEzKT3k8FJ2biATW'
        ]);

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
