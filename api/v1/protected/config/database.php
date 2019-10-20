<?php

/**
 * Este arquivo deveria estar no gitignore, pois contém as credenciais de acesso ao BD. Porém,
 * eu deixei no repositório mesmo para facilitar na hora de vocês testarem.
 */

// This is the database connection configuration.
return array(
	'connectionString' => 'mysql:host=localhost;dbname=vs-challenge',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
);