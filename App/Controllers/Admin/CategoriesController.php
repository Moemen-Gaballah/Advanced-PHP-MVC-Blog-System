<?php
namespace App\Controllers\Admin;

use System\Controller;

class CategoriesController extends Controller
{
	/**
	* Display Categories List
	*
	* @return mixed
	*/ 
	public function index()
	{	
		$this->html->setTitle('Categories');

		$data['categories'] = $this->load->model('Categories')->all();

		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('/admin/categories/list', $data);
		return $this->adminLayout->render($view);
	}


	/**
	* form add Category
	*
	* @return mixed
	*/ 
	public function add()
	{	
		$this->html->setTitle('Categories');

		$view = $this->view->render('/admin/categories/create');
		return $this->adminLayout->render($view);
	}

	/**
	* Store Category
	*
	* @return mixed
	*/ 
	public function submit()
	{	
		// pre($_FILES);
		// dd($_POST);
		$json = [];
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('Categories')->create();
			$json['Success'] = 'Category Has Been Created Successfully';
			$json['redirectTo'] = $this->url->link('admin/categories');
			return $this->url->redirectTo('/admin/categories');
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
		$categoriesModel = $this->load->model('Categories');

		if(! $categoriesModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$data['category'] = $categoriesModel->get($id);

		$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
		$this->html->setTitle('Update ' . $data['category']->name);

		$view = $this->view->render('/admin/categories/edit', $data);
		return $this->adminLayout->render($view);
	}


	/**
	* Update Category
	*
	* @return mixed
	*/ 
	public function save($id)
	{	
		// pre($_FILES);
		// dd($_POST);
		$json = [];
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('Categories')->update($id);

			$this->session->set('success', 'Category Has Been Updated Successfully');
			return $this->url->redirectTo('/admin/categories');
		}else {
			// it means there are errors in form validation  
			$this->session->set('errors', $this->validator->getMessages());

			return $this->url->redirectTo('/admin/categories/edit/'. $id);
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
		$categoriesModel = $this->load->model('Categories');

		if(! $categoriesModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$categoriesModel->delete($id);
		$this->session->set('success', 'Category has been deleted successfully');

		return $this->url->redirectTo('/admin/categories');
	}



	/**
	* Validation the form
	*
	* @return bool
	*/
	private function isValid()
	{
		$this->validator->required('name', 'Category Name is Required');
		return $this->validator->passes();
	}


	
}