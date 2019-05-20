<?php
namespace Api\Helpers;

class Request
{
	protected $get, $server;

	public function __construct()
	{
		$this->get = $_GET;
		$this->server = $_SERVER;
	}
	
	public function get($property, $fallbackValue = null)
	{
		return $this->get[$property] ?? $fallbackValue;
	}
	
	public function server($property, $fallbackValue = null)
	{
		return $this->server[$property] ?? $fallbackValue;
	}
}
