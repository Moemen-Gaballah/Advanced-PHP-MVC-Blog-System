<?php
namespace App\Models;

use System\Model;

class PostsModel extends Model
{
	/**
	* Table name
	*
	* @var string
	*/
	protected $table = 'posts';


	/**
	* Get All Users
	*
	* @return array
	*/
	public function all()
	{
		return $this->select('p.*', 'c.name AS `category`', 'u.first_name', 'u.last_name')
					->from('posts p')
					->join('LEFT JOIN categories c On p.category_id=c.id')
					->join('LEFT JOIN users u On p.user_id=u.id')
					->fetchAll();
	} 



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

		$this->data('title', $this->request->post('title'))
		->data('details', $this->request->post('details'))
		->data('category_id', $this->request->post('category_id'))
		// ->data('related_posts', $this->request->post('related_posts'))
		->data('related_posts', implode(',', array_filter((array) $this->request->post('related_posts'), 'is_numeric')))
		->data('user_id', $user->id)
		->data('tags', $this->request->post('tags'))
		->data('status', $this->request->post('status'))
		->data('created', $now = time())
		->insert('posts');
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

		$this->data('title', $this->request->post('title'))
		->data('details', $this->request->post('details'))
		->data('category_id', $this->request->post('category_id'))
		->data('related_posts', implode(',', array_filter((array) $this->request->post('related_posts'), 'is_numeric')))
		->data('tags', $this->request->post('tags'))
		->data('status', $this->request->post('status'))
		->where('id=?', $id)
		->update($this->table);

	} 

}