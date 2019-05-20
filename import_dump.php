<?php
require 'vendor/autoload.php';

(Dotenv\Dotenv::create(__DIR__))->load();

$dbConfig = require('config/database.php');

exec('mysql -u ' . $dbConfig['username'] . ' -p' . $dbConfig['password'] . ' -h ' . $dbConfig['host'] . ' --database ' . $dbConfig['database'] . ' < dump.sql');
