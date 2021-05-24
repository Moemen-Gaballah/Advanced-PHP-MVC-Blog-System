<?php
namespace System;


class Session
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
	* Start Session
	*
	* @return void
	*/
	public function start()
	{
		ini_set('sessin.use_only_cookies', 1);
		if(! session_id()){
			session_start();
		}
	}

	/**
	* Set new value to Session
	*
	* @param string $key
	* @param mixed $value
	* @return void
	*/
	public function set($key, $value)
	{
		$SESSION[$key] = $value;
	}

	/**
	* Get value from Session by the given key
	*
	* @param string $key
	* @param mixed $value
	* @return void
	*/
	public function get($key, $default = null)
	{
		return array_get($_SESSION, $key, $default);
		// return $_SESSION[$key];
	}

	public function has($key)
	{
		return isset($_SESSION[$key]);
	}

	public function remove($key)
	{
		unset($_SESSION[$KEY]);
	}

	public function pull($key)
	{
		$value = $this->get($key);
		$this->remove($key);
		return $value;
	}

	public function all()
	{
		return $_SESSION;
	}

	public function destroy()
	{
		session_destroy();
		unset($_SESSION);
	}


}