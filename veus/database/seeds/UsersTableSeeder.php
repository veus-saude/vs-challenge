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
        $user = factory(App\User::class)->create([
            'api_token' => 'RNRwNIuyaWseR5Pdgo5idhAk87ef8XME2KoUr8XoSHviSGha7DxRIZ6ZbbVHeBEErjh0UufgBFxhB2AK'
        ]);
    }
}
