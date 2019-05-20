<?php
namespace Api\V1\Controllers;

use Api\Helpers\{Request, Response};

class BaseController
{
	protected $request, $response;

	public function __construct()
	{
		$this->request = new Request;
		$this->response = new Response;
	}
}
