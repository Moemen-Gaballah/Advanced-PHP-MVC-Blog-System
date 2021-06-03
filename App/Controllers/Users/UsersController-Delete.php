<?php
namespace App\Controllers\Admin;

use System\Controller;

class UsersController extends Controller
{
	/**
	* Display Users List
	*
	* @return mixed
	*/ 
	public function index()
	{	
		$this->html->setTitle('Users');

		$data['users'] = $this->load->model('Users')->all();

		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('/admin/users/list', $data);
		return $this->adminLayout->render($view);
	}


	/**
	* Open Users Form
	*
	* @return mixed
	*/ 
	public function add()
	{	
		$this->html->setTitle('Users');

		$view = $this->view->render('/admin/users/create', $data);
		return $this->adminLayout->render($view);
	}

	/**
	* Submit for creating new users
	*
	* @return mixed
	*/ 
	public function submit()
	{	
		
		$json = [];
		
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('Users')->create();
			$json['Success'] = 'Users Has Been Created Successfully';
			$json['redirectTo'] = $this->url->link('admin/users');
			return $this->url->redirectTo('/admin/users');
		}else {
			// it means there are errors in form validation  
			// $json['errors'] = implode('<br>', $this->validator->getMessages());
			$json['errors'] = $this->validator->flattenMessages();

		}

	}


	/**
	* form Edit User
	*
	* @oaram int $id
	* @return mixed
	*/ 
	public function edit($id)
	{	
		$usersModel = $this->load->model('Users');

		if(! $usersModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$data['users'] = $usersModel->get($id);

		$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
		$this->html->setTitle('Update ' . $data['users']->name);

		$view = $this->view->render('/admin/users/edit', $data);
		return $this->adminLayout->render($view);
	}



	/**
	* Update User
	*
	* @return mixed
	*/ 
	public function save($id)
	{	
		$json = [];
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('Users')->update($id);

			$this->session->set('success', 'Users Has Been Updated Successfully');
			return $this->url->redirectTo('/admin/users');
		}else {
			// it means there are errors in form validation  
			$this->session->set('errors', $this->validator->getMessages());

			return $this->url->redirectTo('/admin/users/edit/'. $id);
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
		$usersModel = $this->load->model('Users');

		if(! $usersModel->exists($id) OR $id == 1) {
			return $this->url->redirectTo('/404');
		}

		$usersModel->delete($id);
		$this->session->set('success', 'Users has been deleted successfully');

		return $this->url->redirectTo('/admin/users');
	}



	/**
	* Validation the form
	*
	* @return bool
	*/
	private function isValid()
	{
		$this->validator->required('name', 'Users Name is Required');
		return $this->validator->passes();
	}


	
}