<?php

use App\Models\AddressUsers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        $user1 = User::create([
            'first_name'           => "Administrador",
            'last_name'            => "do Sistema",
            'email'                => "admin@admin",
            'cpf'                  => "11111111111",
            'password'             => bcrypt("cnsa@020459"),
            'terms'                => 1,
            'system'               => 1,
            'institution_id'       => 1,
        ]);
        $user1->roles()->sync([1], true);

        $user2 = User::create([
            'first_name'           => "User",
            'last_name'            => "do Sistema",
            'email'                => "usuario@usuario",
            'cpf'                  => "22222222222",
            'password'             => bcrypt("cnsa@020459"),
            'terms'                => 1,
            'system'               => 1,
            'institution_id'       => 1,
        ]);
        $user2->roles()->sync([2], true);

        $user3 = User::create([
            'first_name'           => "APIUser",
            'last_name'            => "do Sistema",
            'email'                => "apiuser@apiuser",
            'cpf'                  => "33333333333",
            'password'             => bcrypt("cnsa@020459"),
            'terms'                => 1,
            'system'               => 1,
            'institution_id'       => 1
        ]);
        $user3->roles()->sync([3], true);
    }
}
