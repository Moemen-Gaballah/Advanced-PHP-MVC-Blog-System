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
		$data['users_groups'] = $this->load->model('UsersGroups')->all();

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
			return $this->url->redirectTo('/admin/users/create', $errors);

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

		$data['users_groups'] = $this->load->model('UsersGroups')->all();

		$data['user'] = $usersModel->get($id);

		$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
		$this->html->setTitle('Update ' . $data['user']->first_name . ' ' . $data['user']->last_name);

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
		if($this->isValid($id)) {
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
	private function isValid($id = null)
	{
		$this->validator->required('first_name', 'First Name is Required');
		$this->validator->required('last_name', 'Last Name is Required');
		$this->validator->required('email')->email('email');
		$this->validator->required('gender', 'Gender is required');

		if(is_null($id)) {
			// if the id is null
			// then this method is called to create new user
			// so we will validate the password as it should be required
			// and the image as well
			$this->validator->required('password')->minLen('password', 6);
			$this->validator->match('password', 'confirm_password', 'Confirm password should match passwrd');
			$this->validator->requiredFile('image')->image('image');
		}

		return $this->validator->passes();

	}


	
}