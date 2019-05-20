<?php
namespace Api\Helpers;

class URL
{
	public static function getSegments()
	{
		return explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') . '/');
	}
}
