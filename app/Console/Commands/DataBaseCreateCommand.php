<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DataBaseCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esse Command cria a base de dados caso não exista';

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
        $database = env('DB_DATABASE', false);

        if (! $database) {
            $this->info('Ignorando a criação do banco de dados pois env(DB_DATABASE) está vazio');
            return;
        }

        try {
            $host = env('DB_HOST');
            $port = env('DB_PORT');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');

            $pdo = new \PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);

            $pdo->exec("CREATE DATABASE IF NOT EXISTS $database ");

            $this->info(sprintf('DATABSE %s criada com Sucesso', $database));
        } catch (PDOException $exception) {
            $this->error(sprintf('Erro ao criar a DATABASE %s , Mensagem: %s', $database, $exception->getMessage()));
        }
    }

}
