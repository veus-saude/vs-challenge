<?php
namespace Api\V1\Helpers;

class Request
{
	protected $get;

	public function __construct()
	{
		$this->get = $_GET;
	}
	
	public function get($property, $fallbackValue = null)
	{
		return $this->get[$property] ?? $fallbackValue;
	}
}
