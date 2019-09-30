<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Enums\Roles;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin {--D|default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with "admin" role.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Command "app:create-admin" started.');

        if ($this->option('default')) {
            $name = 'Admin';
            $email = 'admin@example.com';
            $password = 'secret';

            $validator = Validator::make(compact('email'), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            if ($this->confirm("Confirm user creation? Name: `$name`; Email: `$email`; Password: `$password`.")) {
                if ($validator->fails()) {
                    $this->error($validator->errors()->first('email'));
                    
                    return;
                }

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => Roles::ADMINISTRATOR,
                ]);

                $this->info('Admin user created.');
            }
        } else {
            $name = $this->ask('Enter user name:');
            $email = $this->ask('Enter user email:');
            $password = $this->secret('Enter user password:');
            $password_confirmation = $this->secret('Confirm user password:');

            $validator = Validator::make(compact('name', 'email', 'password', 'password_confirmation'), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            if ($validator->fails()) {
                collect($validator->errors())
                    ->flatMap(function($item) {
                        return $item;
                    })
                    ->map(function($item) {
                        $this->error($item);

                        return $item;
                    });
                
                $this->info('Command "app:create-admin" aborted.');

                return;
            }

            if ($this->confirm("Confirm user creation? Name: `$name`; Email: `$email`.")) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => Roles::ADMINISTRATOR,
                ]);

                $this->info('Admin user created.');
            }
        }

        $this->info('Command "app:create-admin" ended.');
    }
}
