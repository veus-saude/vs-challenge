<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user')->delete();
        
        \DB::table('user')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'name' => 'Loxas',
                'email' => 'loxas@loxas.com.br',
                'password' => '$2y$10$GOp3Z59YZZieCZSeFZhyTetPlqAUc4XpINaeJXxT.Gtj5MUAAprXu',
                'remember_token' => NULL,
            ),
        ));
        
        
    }
}