<?php
namespace App\Models;

use System\Model;

class CategoriesModel extends Model
{
	/**
	* Table name
	*
	* @var string
	*/
	protected $table = 'categories';

	/**
	* Create new category Record 
	*
	* @return void
	*/

	public function create()
	{
		$this->data('name', $this->request->post('name'))
		->data('status', $this->request->post('status'))
		->insert($this->table);
	} 


	/**
	* Update category Record 
	*
	* @param int $id
	* @return void
	*/
	public function update($id)
	{
		$this->data('name', $this->request->post('name'))
		->data('status', $this->request->post('status'))
		->where('id=?', $id)
		->update($this->table);
	} 
}