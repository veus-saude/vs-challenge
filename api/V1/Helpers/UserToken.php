<?php
namespace Api\V1\Helpers;

use Api\V1\Models\User;

class UserToken
{
	public static function check()
	{
		return (bool) self::getUser();
	}
	
	public static function getUser()
	{
		return isset($_SERVER['HTTP_API_TOKEN']) ? User::where('api_token', $_SERVER['HTTP_API_TOKEN'])->first() : null;
	}
}
