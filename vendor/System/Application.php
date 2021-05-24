<?php
namespace System;

class Application
{
	/**
	* Container
	*
	* @var array
	*/
	private $container = [];

	private static $instance;

	/**
	* Constructor
	*
	* @param \System\File $file
	*/

	private function __construct(File $file)
	{
		$this->share('file', $file);
		$this->registerClasses();
		$this->loadHelpers();
		// $this->run();
	}

	/**
	* Get Application Instance
	*
	* @return \System\Application
	*/
	public static function getInstance($file = null)
	{
		if (is_null(static::$instance)){
			static::$instance = new static($file);// or new self 
		}
		return static::$instance;
	}

	/**
	* Run the Application
	*
	* @return void
	*/
	public function run()
	{
		$this->session->start();
		$this->request->prepareUrl();
		$this->file->call('App/index.php');
		list($controller, $method, $arguments) = $this->route->getProperRoute();
	
		// $this->load->controller($controller);
		$output = (string) $this->load->action($controller, $method, $arguments);

		$this->response->setOutput($output);

		$this->response->send();
	}





	/**
	* Register classes in spl autoload register
	* 
	* @return void
	*/

	private function registerClasses()
	{
		
		spl_autoload_register(function ($class) {
			if(strpos($class, 'App') === 0){
				$file = $class.'.php';
			}else {
				// get class from vendor 
				$file = 'vendor/'.$class.'.php';
				
			}
			if($this->file->exists($file)){
				$this->file->call($file);
			}
		    // include $class . '.php';
		});

	}

	/**
	* Load Helper File
	*
	* @return void
	*/

	private function loadHelpers()
	{
		$this->file->call('vendor/helpers.php');
	}

	/**
	*	Get Shared Value
	*
	*	@param string $key
	*   @return mixed
	*/

	public function get($key)
	{
		if(! $this->isSharing($key)){
			if($this->isCoreAlias($key)){
				$this->share($key, $this->createNewCoreObject($key));
			}else {
				die('<b>'. $key . '</b> not found in application container');
			}
		}


		return $this->container[$key];
	}

	public function isSharing($key)
	{
		return isset($this->container[$key]);
	}

	public function isCoreAlias($alias)
	{
		$coreClasses = $this->coreClasses();
		return isset($coreClasses[$alias]);
	}

	private function createNewCoreObject($alias)
	{
		$coreClasses = $this->coreClasses();
		$object = $coreClasses[$alias];
		return new $object($this);
	}

	/**
	* Get All Core Classes with its aliases
	*
	* @return array
	*/

	private function coreClasses()
	{
		return [
			'request' => 'System\\Http\\Request',
			'response' => 'System\\Http\\Response',
			'session' => 'System\\Session',
			'route' => 'System\\Route',
			'cookie' => 'System\\Cookie',
			'load' => 'System\\Loader',
			'html' => 'System\\Html',
			'db' => 'System\\Database',
			'view' => 'System\\View\\ViewFactory',
			'url' => 'System\\Url'
		];
	}

	/**
	* Share the given Key|value Through Application
	*
	* @param string $key
	* @param mixed $value
	* @return mixed
	*/

	public function share($key, $value)
	{
		$this->container[$key] = $value; 
	}


	/**
	*	Get Shared Value dynamically
	*
	*	@param string $key
	*   @return mixed
	*/

	public function __get($key)
	{
		return $this->get($key);
	}
}