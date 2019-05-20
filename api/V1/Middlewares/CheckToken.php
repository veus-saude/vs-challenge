<?php
namespace Api\V1\Middlewares;

use Api\Helpers\Response;
use Api\V1\Helpers\UserToken;

class CheckToken
{
	public function __construct()
	{
		if(!UserToken::check()) {
			return exit((new Response(401))->plain('Não autorizado'));
		}
	}
}
