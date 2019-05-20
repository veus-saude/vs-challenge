<?php
return [
	'driver' => 'mysql',
	'host' => '127.0.0.1',
	'database' => getenv('DB_DATABASE'),
	'username' => getenv('DB_USERNAME'),
	'password' => getenv('DB_PASSWORD')
];
