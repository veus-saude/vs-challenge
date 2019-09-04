<?php

/**
 * Desenvolvido por: Lucas Maia - lucas.codemax@gmail.com
 * WhatsApp: (21) 96438-6937
 *
 * Date: Wed, 28 Aug 2019 00:56:59 -0300.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property \Carbon\Carbon $last_login
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $dates = [
		'last_login'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'last_login'
	];
}
