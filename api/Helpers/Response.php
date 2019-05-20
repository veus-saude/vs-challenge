<?php
namespace Api\Helpers;

class Response
{
	public function __construct($statusCode = 200)
	{
		if($statusCode) http_response_code($statusCode);
	}
	
	public function json($content)
	{
		header('Content-Type: application/json');
		
		return json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
	
	public function plain($content)
	{
		header('Content-Type: text/plain');
	
		return $content;
	}
}
