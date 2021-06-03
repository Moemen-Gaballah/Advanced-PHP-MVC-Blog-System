<?php
namespace System\Http;

class Request
{
	private $url;
	private $baseUrl;

	/**
	* Uploaded files container
	*
	* @var array
	*/
	private $files = [];

	/**
	* Prepare url
	*
	* @return void
	*/

	public function prepareUrl()
	{
		$script = dirname($this->server('SCRIPT_NAME'));
		$requestUri = $this->server('REQUEST_URI');
		if(strpos($requestUri, '?') !== false){
			list($requestUri, $queryString) = explode('?', $requestUri);
		}

		$this->url = rtrim(preg_replace('#^'.$script.'#', '', $requestUri), '/');

		if(! $this->url) {
			$this->url = '/';
		}

		$this->baseUrl = $this->server('REQUEST_SCHEME') . '://' . $this->server('HTTP_HOST') . $script . '/';
	}

	public function get($key, $default = null)
	{
		return array_get($_GET, $key, $default);
	}

	public function post($key, $default = null)
	{
		return array_get($_POST, $key, $default);
	}

	public function server($key, $default = null)
	{
		return array_get($_SERVER, $key, $default);
	}

	public function method()
	{
		return $this->server('REQUEST_METHOD');
	}

	/**
	* Get the referer link 
	*
	* @return string
	*/
	public function referer()
	{
		return $this->server('HTTP_REFERER');
	}
	public function baseUrl()
	{
		return $this->baseUrl;
	}
	
	public function url()
	{
		return $this->url;
	}

	/**
	* Get the upladed File objecy for the given input
	*
	* @param string $input
	* @return \System\Http\UploadedFile
	*/

	public function file($input)
	{
		if(isset($this->files[$input])){
			return $this->files[$input];
		}

		$UploadedFile = new UploadedFile($input);
		$this->files[$input] = $UploadedFile;

		return $this->files[$input];
	}


}