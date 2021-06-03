<?php
namespace System;

use PDO;
use PDOException;

class Database
{
	/**
	* Application Object
	*
	* @var \System\Application
	*/	
	private $app;

	/**
	* PDO Connection
	*
	* @var \PDO
	*/	
	private static $connection;

	/**
	* Table Name
	*
	* @var string
	*/	
	private $table;

	/**
	* Data Container
	*
	* @var array
	*/	
	private $data = [];

	/**
	* Bindings Container
	*
	* @var array
	*/	
	private $bindings = [];

	/**
	* Last Insert Id
	*
	* @var int
	*/	
	private $lastId;


	/**
	* Wheres
	*
	* @var array
	*/	
	private $wheres = [];


	/**
	* Havings
	*
	* @var array
	*/	
	private $havings = [];


	/**
	* Group By
	*
	* @var array
	*/	
	private $groupBy = [];


	/**
	* Selects
	*
	* @var array
	*/	
	private $selects = [];


	/**
	* Joins
	*
	* @var array
	*/	
	private $joins = [];

	/**
	* Limit
	*
	* @var int
	*/	
	private $limit;


	/**
	* offset
	*
	* @var int
	*/	
	private $offset;


	/**
	* Total
	*
	* @var int
	*/	
	private $rows = 0;


	/**
	* Order By
	*
	* @var int
	*/	
	private $orderBy = [];


	/**
	* Constructor
	*
	* @param \System\Application $app
	*/
	public function __construct(Application $app)
	{
		$this->app = $app;
		if(! $this->isConnected())
		{
			$this->connect();
		}
	}


	/**
	* Determine if there is any connection to database
	*
	* @return bool
	*/
	private function isConnected()
	{

		return static::$connection instanceof PDO; // instance meaning => $connection is object from PDO  
	}

	/**
	* connect to Database
	*
	* @return void
	*/
	private function connect()
	{
		$connectionData = $this->app->file->call('config.php');
		extract($connectionData);
		try{
			static::$connection = new PDO('mysql:host=' . $server . ';dbname='. $dbname, $dbuser, $dbpass);

			static::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			static::$connection->exec('SET NAMES utf8');
		} catch(PDOException $e){
			echo $sql;
			pre($this->bindings);
			die($e->getMessage());
		}
	} //end method connect


	/**
	* Get Database connection Object PDO object
	*
	* @return \PDO
	*/
	public function connection()
	{
		return static::$connection;
	}


	/**
	* Set Select clause
	*
	* @param string $select
	* @return $this
	*/
	public function select(...$select)
	{
		// for those who use php 5.6 
		// you can use the ...operator

		// otherwise , use the following line to get all passed arguments
		$selects = func_get_args();

		$this->selects = array_merge($this->selects, $selects);
		// $this->selects[] = $select;
		return $this;
	}


	/**
	* Set join clause
	*
	* @param string $join
	* @return $this
	*/
	public function join($join)
	{
		$this->joins[] = $join;
		return $this;
	}

	/**
	* Set Order By clause
	*
	* @param string $column
	* @param string $sort
	* @return $this
	*/
	public function orderBy($orderBy, $sort = 'ASC')
	{
		$this->orderBy = [$orderBy, $sort];
		return $this;
	}


	/**
	* Set Limit && Offset clause
	*
	* @param string $join
	* @return $this
	*/
	public function limit($limit, $offset = 0)
	{
		$this->limit = $limit;
		$this->offset = $offset;
		return $this;
	}


	/**
	* Fetch Table
	* This will return only one record
	* 
	* @param string $table
	* @return \stdClass | null
	*/
	public function fetch($table = null)
	{
		if ($table){
			$this->table($table);
		}

		$sql = $this->fetchStatement();

		$result = $this->query($sql, $this->bindings)->fetch();

		$this->reset();

		return $result;
	}


	/**
	* Fetch All Records from Table
	* This will return only one record
	* 
	* @param string $table
	* @return array
	*/
	public function fetchAll($table = null)
	{
		if ($table){
			$this->table($table);
		}

		$sql = $this->fetchStatement();

		$query = $this->query($sql, $this->bindings);
		$results = $query->fetchAll();

		$this->rows = $query->rowCount();
		$this->reset();

		return $results;
	}

	/**
	* Get total rows  from last fetch all statement
	*
	* @return int 
	**/
	public function rows()
	{
		return $this->rows;
	}

	/**
	* Prepare Select Statement
	*
	* @return string
	*/
	private function fetchStatement()
	{
		$sql = 'SELECT ';

		if($this->selects) {
			$sql .= implode(',' ,  $this->selects);
		}else {
			$sql .= '*';
		}

		$sql .= ' FROM ' . $this->table . ' ';

		if ($this->joins){
			$sql .= implode(' ', $this->joins);
		}

		if ($this->wheres){
			$sql .= ' WHERE ' . implode(' ', $this->wheres) . ' ';
		}

		if ($this->limit){
			$sql .= ' LIMIT ' . $this->limit;
		}

		if ($this->offset){
			$sql .= ' OFFSET ' . $this->offset;
		}

		if($this->havings) {
			$sql .= ' HAVING ' . implode(' ', $this->havings) . ' ';
		}

		if($this->groupBy) {
			$sql .= ' GROUP BY ' . implode(' ', $this->groupBy) . ' ';
		}

		if ($this->orderBy){
			$sql .=  ' ORDER BY ' . implode(' ', $this->orderBy);
		}

		return $sql;
	}

	/*
	* Set the table name
	*
	* @param string $table
	* @return $this
	*/
	public function table($table)
	{
		$this->table = $table;
		return $this;
	}

	/*
	* Set the table name
	*
	* @param string $table
	* @return $this
	*/
	public function from($table)
	{
		return $this->table($table);
	}

	/**
	* Delete Clause
	*
	* @param string $table
	* @return $this
	*/
	public function delete($table = null)
	{
		if($table)
		{
			$this->table($table);
		}

		$sql = 'DELETE FROM ' . $this->table . ' ';

		if($this->wheres){
			$sql .= ' WHERE ' . implode('', $this->wheres);
		}
	
		$this->query($sql, $this->bindings);
		$this->reset();

		return $this;
	}


	/*
	* Set the that will be stored in database table
	*
	* @param mixed $key
	* @param mixed $value
	* @return $this
	*/
	public function data($key, $value = null)
	{
		if(is_array($key))
		{
			$this->data = array_merge($this->data, $key);
			$this->addToBindings($key);
		}else {
			$this->data[$key] = $value;
			$this->addToBindings($value);
		}
		
		return $this;
	}

	/**
	* Insert Data to database
	*
	* @param string $table
	* @return $this
	*/

	public function insert($table = null)
	{
		if($table)
		{
			$this->table($table);
		}

		$sql = 'INSERT INTO ' . $this->table . ' SET ';

		$sql .= $this->setFields();
		
		
		$this->query($sql, $this->bindings);
		$this->lastId = $this->connection()->lastInsertId();
		$this->reset();
		return $this;
	}

	/*
	* Set the fields for insert and update
	*
	* @return string
	*/
	private function setFields()
	{
		$sql = '';

		foreach (array_keys($this->data) as $key) {
			$sql .= '`' . $key  . '` = ? , ';
		}

		$sql = rtrim($sql, ', ');
		
		return $sql;
	}



	/**
	* Update Data to database
	*
	* @param string $table
	* @return $this
	*/
	public function update($table = null)
	{
		if($table)
		{
			$this->table($table);
		}

		$sql = 'UPDATE ' . $this->table . ' SET ';
		$sql .= $this->setFields();

		if($this->wheres){
			$sql .= ' WHERE ' . implode('', $this->wheres);
		}
	
		$this->query($sql, $this->bindings);

		$this->reset();

		return $this;
	}



	/**
	* Add new Where clause
	*
	* @return $this
	*/
	public function where()
	{
		$bindings = func_get_args();

		$sql = array_shift($bindings);

		$this->addToBindings($bindings);

		$this->wheres[] = $sql;

		return $this;
	}


	/**
	* Add new Having clause
	*
	* @return $this
	*/
	public function havings()
	{
		$bindings = func_get_args();

		$sql = array_shift($bindings);

		$this->addToBindings($bindings);

		$this->havings[] = $sql;

		return $this;
	}


	/**
	* Group By Clause
	*
	* @param array $arguments
	* @return $this
	*/
	public function groupBy(...$arguments)
	{
		$this->groupBy = $arguments;
		return $this;
	}


	/**
	* Execute the given sql statement
	*
	* @return \PDOStatement
	*/
	public function query()
	{
		$bindings = func_get_args(); // or add .(...$binding) as a prameter in this method (query).

		$sql = array_shift($bindings);
		if(count($bindings) == 1 AND is_array($bindings[0]))
		{
			$bindings = $bindings[0];
		}

		try {

			$query = $this->connection()->prepare($sql);
			foreach ($bindings as $key => $value) {
				$query->bindValue($key + 1, $value);
			}

			$query->execute();
				// pre($query);
			return $query;
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	* Get the Last Insert Id
	*
	* @return int
	*/
	public function lastId()
	{
		return $this->lastId;
	}

	/**
	* Add the given value to bindings
	*
	* @param mixed $value
	* @return void
	*/
	private function addToBindings($value)
	{
		if(is_array($value))
		{
			$this->bindings = array_merge($this->bindings, array_values($value));
		}else{
			$this->bindings[] = $value;
		}
		// $this->bindings[] = _e($value); // |_e function in file helper to scape Html chars
	}

	/**
	* Rest All Data
	*
	* @return void
	*/

	private function reset()
	{
		$this->limit = null;
		$this->table = null;
		$this->offset = null;
		$this->data = [];
		$this->joins = [];
		$this->wheres = [];
		$this->orderBy = [];
		$this->havings = [];
		$this->groupBy = [];
		$this->selects = [];
		$this->bindings = [];

	}

	
}