<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query = file_get_contents(base_path('database/seeders/produtos_insert.sql'));

        $linha1 = "USE `" . env('DB_DATABASE') . "`;\n";
        $q =  $linha1 . $query;
        if (env('DB_CONNECTION') == 'mysql') {
           echo DB::unprepared($q);
        } else {
          echo  DB::unprepared($query);
        }
    }
}
