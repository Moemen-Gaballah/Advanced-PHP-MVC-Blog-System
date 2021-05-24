<?php
namespace System;

class File
{
	/**
	* Directory Seperator
	*
	* @const string
	*/

	const DS = DIRECTORY_SEPARATOR;

	/**
	* Root Path
	*
	* @var string
	*/
	
	private $root;

	/**
	* Constructor
	*
	* @param string $root 
	*/

	public function __construct($root)
	{
		$this->root = $root;
	}

	/**
	* Determine wether the given file path exists
	* 
	* param string $file
	* @return bool
	*/

	public function exists($file)
	{
		return file_exists($this->to($file));
	}

	

	/**
	* Require the given file
	* 
	* param string $file
	* @return vid
	*/
	public function call($file)
	{
		return require $this->to($file);
		// return $file;
	}

	public function toVendor($path)
	{
		return $this->to('vendor/'.$path); 
	}

	public function to($path)
	{
		return $this->root . self::DS . str_replace(['/', '\\'], self::DS, $path); 
	}
}