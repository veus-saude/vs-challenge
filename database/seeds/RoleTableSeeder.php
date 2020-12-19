<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        $role1 = Role::create([
            'id'                   =>1,
            'name'                 =>'Administrator',
            'label'                =>'Administrador Master',
            'system'               =>1,
            'group'                =>'Funções do Sistema'
        ]);
        $role2 = Role::create([
            'id'                   =>2,
            'name'                 =>'Usuários',
            'label'                =>'User do Sistema',
            'system'               =>1,
            'group'                =>'Funções do Sistema'
        ]);
        $role3 = Role::create([
            'id'                   =>3,
            'name'                 =>'APIUser',
            'label'                =>'User da API',
            'system'               =>1,
            'group'                =>'Funções do Sistema'
        ]);
    }
}
