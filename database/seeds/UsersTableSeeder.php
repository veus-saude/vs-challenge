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
        $user = app(\App\Repositories\UserRepository::class);
        $user->create([
            'name' => 'admin',
            'email' => 'admin@admin.com.br',
            'password' => app('hash')->make('123456')
        ]);
        factory(\App\Models\User::class,5)
            ->create()->each(function($user){
                $user->save();
            });
    }
}
