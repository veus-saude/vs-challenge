<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        $this->call(ProdutoTableSeeder::class);
        $this->call(FornecedorTableSeeder::class);
        $this->call(EstoqueTableSeeder::class);
    }
}
