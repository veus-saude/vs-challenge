<?php
namespace Api\V1\Middlewares;

use Api\V1\Models\User;
use Api\Helpers\Response;

class CheckToken
{
	public function __construct()
	{
		if(!isset($_SERVER['HTTP_API_TOKEN']) or !User::where('api_token', $_SERVER['HTTP_API_TOKEN'])->first()) {
			return exit((new Response(401))->plain('Não autorizado'));
		}
	}
}
