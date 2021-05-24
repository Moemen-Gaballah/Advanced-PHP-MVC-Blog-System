<?php
namespace System;


class Cookie
{
	/*
	* Application Object
	*
	* @var \System\Application
	*/
	private $App;
	
	function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	* Set new value to Cookie
	*
	* @param string $key
	* @param mixed $value
	* @param int $hours
	* @return void
	*/
	public function set($key, $value, $hours = 1800)
	{
		setcookie($key, $value, time() + $hours * 3600, '', '', false, true);
	}

	/**
	* Get value from Cookies by the given key
	*
	* @param string $key
	* @param mixed $value
	* @return void
	*/
	public function get($key, $default = null)
	{
		return array_get($_COOKIE, $key, $default);
	}

	public function has($key)
	{
		// return isset($_COOKIE[$key]);
		return array_key_exists($key, $_COOKIE);
	}

	public function remove($key)
	{
		setcookie($key, null, -1);
		unset($_COOKIE[$key]);
	}

	public function all()
	{
		return $_COOKIE;
	}

	public function destroy()
	{
		foreach (array_keys($this->all()) as $key) {
			$this->remove($key);
		}

		unset($_COOKIE);
	}


}