<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/dump/users.json");
        if (!empty($json)) {
            $dados = json_decode($json);
            foreach ($dados as $dado) :
                User::create([
                    'id' => $dado->id,
                    'name' => $dado->name,
                    'email' => $dado->email,
                    'password' => $dado->password,
                    'remember_token' => $dado->remember_token,
                    'created_at' => $dado->created_at,
                    'updated_at' => $dado->updated_at,
                ]);
            endforeach;
        }
    }
}
