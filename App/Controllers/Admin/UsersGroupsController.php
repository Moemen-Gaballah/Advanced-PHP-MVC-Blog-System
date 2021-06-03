<?php
namespace App\Controllers\Admin;

use System\Controller;

class UsersGroupsController extends Controller
{
	/**
	* Display Users Groups List
	*
	* @return mixed
	*/ 
	public function index()
	{	
		
		$this->html->setTitle('Users Groups');

		$data['users_groups'] = $this->load->model('UsersGroups')->all();

		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('/admin/users-groups/list', $data);
		return $this->adminLayout->render($view);
	}


	/**
	* Open Users Groups Form
	*
	* @return mixed
	*/ 
	public function add()
	{	
		$this->html->setTitle('Users Groups');
		$data['pages'] = $this->getPermissionPages();

		$view = $this->view->render('/admin/users-groups/create', $data);
		return $this->adminLayout->render($view);
	}

	/**
	* Submit for creating new users group
	*
	* @return mixed
	*/ 
	public function submit()
	{	
		
		$json = [];
		
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('UsersGroups')->create();
			$json['Success'] = 'Users Group Has Been Created Successfully';
			$json['redirectTo'] = $this->url->link('admin/users-groups');
			return $this->url->redirectTo('/admin/users-groups');
		}else {
			// it means there are errors in form validation  
			// $json['errors'] = implode('<br>', $this->validator->getMessages());
			$json['errors'] = $this->validator->flattenMessages();

		}

	}


	/**
	* form Edit Category
	*
	* @oaram int $id
	* @return mixed
	*/ 
	public function edit($id)
	{	
		$categoriesModel = $this->load->model('UsersGroups');

		$data['pages'] = $this->getPermissionPages();

		if(! $categoriesModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$data['users_groups'] = $categoriesModel->get($id);

		$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
		$this->html->setTitle('Update ' . $data['users_groups']->name);

		// pred($data['users_groups']->pages);
		$view = $this->view->render('/admin/users-groups/edit', $data);
		return $this->adminLayout->render($view);
	}


	/**
	* Get All Permission Pages
	*
	* @return array
	*/
	private function getPermissionPages()
	{
		$permission = [];

		foreach ($this->route->routes() as $route) {
			if(strpos($route['url'], '/admin') === 0) {
				$permissions[] = $route['url'];
			}
		}
			return $permissions;
	}




	/**
	* Update Category
	*
	* @return mixed
	*/ 
	public function save($id)
	{	
		$json = [];
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('UsersGroups')->update($id);

			$this->session->set('success', 'Users Groups Has Been Updated Successfully');
			return $this->url->redirectTo('/admin/users-groups');
		}else {
			// it means there are errors in form validation  
			$this->session->set('errors', $this->validator->getMessages());

			return $this->url->redirectTo('/admin/users-groups/edit/'. $id);
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
		$usersGroupsModel = $this->load->model('UsersGroups');

		if(! $usersGroupsModel->exists($id) OR $id == 1) {
			return $this->url->redirectTo('/404');
		}

		$usersGroupsModel->delete($id);
		$this->session->set('success', 'Users Groups has been deleted successfully');

		return $this->url->redirectTo('/admin/users-groups');
	}



	/**
	* Validation the form
	*
	* @return bool
	*/
	private function isValid()
	{
		$this->validator->required('name', 'Users Groups Name is Required');
		return $this->validator->passes();
	}


	
}