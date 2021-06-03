<?php
namespace App\Models;

use System\Model;

class SettingsModel extends Model
{
	/**
	* Table name
	*
	* @var string
	*/
	protected $table = 'settings';


	/**
	* Create new Users Record 
	*
	* @return void
	*/
	public function create()
	{
		$image = $this->uploadImage();

		if($image) {
			$this->data('image', $image);
		}

		$user = $this->load->model('Login')->user();

		$this->data('name', $this->request->post('name'))
		->data('link', $this->request->post('link'))
		->data('start_at', strtotime($this->request->post('start_at')))
		->data('end_at', strtotime($this->request->post('end_at')))
		->data('status', $this->request->post('status'))
		->data('page', $this->request->post('page'))
		->data('created', $now = time())
		->insert('ads');
	} 


	/**
	* Upload User Image
	*
	* @return string
	*/
	private function uploadImage()
	{
		$image = $this->request->file('image');
		if(!$image->exists())
		{
			return '';
		}
		return $image->moveTo($this->app->file->toPublic('uploads/images'));
	}


	/**
	* Update Users Group Record 
	*
	* @param int $id
	* @return void
	*/
	public function update($id)
	{
		$image = $this->uploadImage();

		if($image) {
			$this->data('image', $image);
		}

		$this->data('name', $this->request->post('name'))
		->data('link', $this->request->post('link'))
		->data('start_at', strtotime($this->request->post('start_at')))
		->data('end_at', strtotime($this->request->post('end_at')))
		->data('status', $this->request->post('status'))
		->data('page', $this->request->post('page'))
		->data('created', $now = time())
		->where('id=?', $id)
		->update($this->table);

	} 

}