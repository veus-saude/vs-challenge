<?php

use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_list = ['seringa', 'luva', 'agulha', 'bandage'];
        $type_db = [];
        foreach($type_list as $type){
            $type_db[] = [
                'name' => $type
            ];
        }

        $type_created = \App\Source\Types::insert($type_db);
    }
}
