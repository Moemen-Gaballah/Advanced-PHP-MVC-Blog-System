<?php
namespace System;

abstract class Model
{
	/**
	* Application Object
	*
	* @var \System\Application
	*/	
	protected $app;


	/**
	* Table name
	*
	* @var string
	*/
	protected $table;


	/**
	* Constructor
	*
	* @param \System\Application $app
	*/
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	* Call share application objects dynamically
	*
	* @param string $key
	* @return mixed
	*/

	public function __get($key)
	{
		return $this->app->get($key);
	}

	/*
	* Call Database methoda dynamically
	*
	* @param string $method
	* @param array $args
	* @return mixed
	*/

	public function __call($method, $args)
	{
		return call_user_func_array([$this->app->db, $method], $args);
	}

	/**
	* Get All Model Records;
	*
	* @return array
	*/

	public function all()
	{
		// return $this->db->fetchAll(); // not use this because call_user_func_array => call db
		return $this->fetchAll($this->table);
	}

	/**
	* Get Item In model By Id
	*
	* @param int $id
	* @return \stdClass | null
	*/
	public function get($id)
	{
		return $this->where('id = ?' , $id)->fetch($this->table);
	}


	/**
	* Determine if the give value of the key key exists in table
	*
	* @param mixed $value
	* @param string $key
	* @ return
	*/
	public function exists($value, $key = 'id')
	{	
		return (bool) $this->select($key)->where($key .'=?', $value)->fetch($this->table);
	}


	/**
	* Delete Record By Id
	*
	* @param int $id
	* @param string $key
	* @ return void
	*/
	public function delete($id)
	{	
		return $this->where('id = ?', $id)->delete($this->table);
	}
}