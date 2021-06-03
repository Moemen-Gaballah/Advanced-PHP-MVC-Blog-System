<?php
namespace App\Controllers\Admin;

use System\Controller;

class AdsController extends Controller
{
	/**
	* Display Ads List
	*
	* @return mixed
	*/ 
	public function index()
	{	
		
		$this->html->setTitle('Ads');

		$data['ads'] = $this->load->model('Ads')->all();

		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('/admin/ads/list', $data);
		return $this->adminLayout->render($view);
	}


	/**
	* Open Ad Form
	*
	* @return mixed
	*/ 
	public function add()
	{	
		$this->html->setTitle('Ads');
		$data['ads'] = $this->load->model('Ads')->all();

		$data['pages'] = $this->getPermissionPages();
		$data['categories'] = $this->load->model('Categories')->all();


		$view = $this->view->render('/admin/ads/create', $data);
		return $this->adminLayout->render($view);
	}

	/**
	* Submit for creating new Ad
	*
	* @return mixed
	*/ 
	public function submit()
	{	
		
		$json = [];
		
		if($this->isValid()) {
			// it means there are no errors in from validation
			$this->load->model('Ads')->create();
			$json['Success'] = 'Ads Has Been Created Successfully';
			$json['redirectTo'] = $this->url->link('admin/ads');
			return $this->url->redirectTo('/admin/ads');
		}else {
			// it means there are errors in form validation  
			// $json['errors'] = implode('<br>', $this->validator->getMessages());

			// $json['errors'] = $this->validator->flattenMessages();
			return  $this->validator->flattenMessages();


		}

	}


	/**
	* form Edit Ad
	*
	* @oaram int $id
	* @return mixed
	*/ 
	public function edit($id)
	{	
		$adsModel = $this->load->model('Ads');

		if(! $adsModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$data['pages'] = $this->getPermissionPages();

		$data['categories'] = $this->load->model('Categories')->all();
		$data['ads'] = $this->load->model('Ads')->all();

		$data['ad'] = $adsModel->get($id);

		$data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;
		$this->html->setTitle('Update ' . $data['ad']->name);

		$view = $this->view->render('/admin/ads/edit', $data);
		return $this->adminLayout->render($view);
	}



	/**
	* Update Ad
	*
	* @return mixed
	*/ 
	public function save($id)
	{	
		$json = [];
		if($this->isValid($id)) {
			// it means there are no errors in from validation
			$this->load->model('Ads')->update($id);

			$this->session->set('success', 'Ad Has Been Updated Successfully');
			return $this->url->redirectTo('/admin/ads');
		}else {
			// it means there are errors in form validation  
			$this->session->set('errors', $this->validator->getMessages());

			return $this->url->redirectTo('/admin/ads/edit/'. $id);
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
		$adsModel = $this->load->model('Ads');

		if(! $adsModel->exists($id) OR $id == 1) {
			return $this->url->redirectTo('/404');
		}

		$adsModel->delete($id);
		$this->session->set('success', 'Ad has been deleted successfully');

		return $this->url->redirectTo('/admin/ad');
	}



	/**
	* Validation the form
	*
	* @return bool
	*/
	private function isValid($id = null)
	{
		$this->validator->required('link');
		$this->validator->required('page');
		$this->validator->required('start_at');
		$this->validator->required('end_at');

		if(is_null($id)) {
			$this->validator->requiredFile('image')->image('image');
		}else {
			$this->validator->image('image');
		}

		return $this->validator->passes();

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
			if(strpos($route['url'], '/admin') !== 0) {
				$permissions[] = $route['url'];
			}
		}
			return $permissions;
	}

	
}