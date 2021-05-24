<?php
use System\Application;


if(! function_exists('pre')) {
	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
}

if(! function_exists('dd')) {
	function dd($var){
		var_dump($var);
		die();
	}
}

if(! function_exists('array_get')) {
	/**
	* Get the value from the given array for the given key if found
	* otherwise get the default value
	*
	* @param array $array
	* @param string|int $key
	* @param mixed $default
	*/
	function array_get($array, $key,$default = null){
		return isset($array[$key]) ? $array[$key] : $default;
	}
}


if(! function_exists('_e')) {
	/**
	* Escape the give value
	*
	* @param string $value
	* @return string
	*/
	function _e($value){
		return htmlspecialchars($value);
	}
}

if(! function_exists('assets')) {
	function assets($path){
		// global $app;  or another way
		$app = Application::getInstance();
		
		return $app->url->link('public/'. $path);
	}
}


