<?php
namespace App\Controllers\Admin;

use System\Controller;

class PostsController extends Controller
{
	/**
	* Display Posts List
	*
	* @return mixed
	*/ 
	public function index()
	{	
		
		$this->html->setTitle('Posts');

		$data['posts'] = $this->load->model('Posts')->all();

		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('/admin/posts/list', $data);
		return $this->adminLayout->render($view);
	}


	/**
	* Open Post Form
	*
	* @return mixed
	*/ 
	public function add()
	{	
		$this->html->setTitle('Posts');
		$data['posts'] = $this->load->model('Posts')->all();
		$data['categories'] = $this->load->model('Categories')->all();


		$view = $this->view->render('/admin/posts/create', $data);
		return $this->adminLayout->render($view);
	}

	/**
	* Submit for creating new Post
	*
	* @return mixed
	*/ 
	public function submit()
	{	
		
		$json = [];
		
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('Posts')->create();
			$json['Success'] = 'Posts Has Been Created Successfully';
			$json['redirectTo'] = $this->url->link('admin/posts');
			return $this->url->redirectTo('/admin/posts');
		}else {
			// it means there are errors in form validation  
			// $json['errors'] = implode('<br>', $this->validator->getMessages());
			$json['errors'] = $this->validator->flattenMessages();

		}

	}


	/**
	* form Edit Post
	*
	* @oaram int $id
	* @return mixed
	*/ 
	public function edit($id)
	{	
		$postsModel = $this->load->model('Posts');

		if(! $postsModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$data['categories'] = $this->load->model('Categories')->all();
		$data['posts'] = $this->load->model('Posts')->all();

		$data['post'] = $postsModel->get($id);

		$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
		$this->html->setTitle('Update ' . $data['post']->title);

		$view = $this->view->render('/admin/posts/edit', $data);
		return $this->adminLayout->render($view);
	}



	/**
	* Update Post
	*
	* @return mixed
	*/ 
	public function save($id)
	{	
		$json = [];
		if($this->isValid($id)) {
			// it means there are no errors in from validation
			$this->load->model('Posts')->update($id);

			$this->session->set('success', 'Post Has Been Updated Successfully');
			return $this->url->redirectTo('/admin/posts');
		}else {
			// it means there are errors in form validation  
			$this->session->set('errors', $this->validator->getMessages());

			return $this->url->redirectTo('/admin/posts/edit/'. $id);
		}

	}


	/** 
	* Delete Record
	*
	* @param int $id
	* @return mixed
	*/
	public function delete($id)
	{
		$postsModel = $this->load->model('Posts');

		if(! $postsModel->exists($id) OR $id == 1) {
			return $this->url->redirectTo('/404');
		}

		$postsModel->delete($id);
		$this->session->set('success', 'Post has been deleted successfully');

		return $this->url->redirectTo('/admin/posts');
	}



	/**
	* Validation the form
	*
	* @return bool
	*/
	private function isValid($id = null)
	{
		$this->validator->required('title');
		$this->validator->required('details');
		$this->validator->required('tags');

		if(is_null($id)) {
			$this->validator->requiredFile('image')->image('image');
		}else {
			$this->validator->image('image');
		}

		return $this->validator->passes();

	}


	
}