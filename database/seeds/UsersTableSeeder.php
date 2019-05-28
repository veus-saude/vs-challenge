<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new User;
        $u->name = 'Veus';
        $u->email = 'teste@veus.com.br';
        $u->password = Hash::make('teste-veus');
        $u->save();
    }
}
