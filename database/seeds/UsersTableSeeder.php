<?php

use App\User;
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
        $mail = 'thalesnathan@veus.com.br';

        /*
         * Always creating 10 users, and ensuring thalesnathan@veus.com.br has been created
         */
        if (empty(User::whereEmail($mail)->first())) {
            DB::table('users')->insert([
                'name' => 'Thales Nathan',
                'email' => $mail,
                'password' => bcrypt('V3u5T35t3'),
                'api_token' => 'ipLdZcdPwqE9oY3VaoO336FQ4e0XtiJkKaH8kMa8eTxWUh0ADRNk7G6rqSwn',
            ]);

            factory(User::class, 9)->create();
        } else factory(User::class, 10)->create();

    }
}
