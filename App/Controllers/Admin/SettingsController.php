<?php
namespace App\Controllers\Admin;

use System\Controller;

class SettingsController extends Controller
{
	/**
	* Display Settings List
	*
	* @return mixed
	*/ 
	public function index()
	{	
		
		$this->html->setTitle('Settings');

		$data['settings'] = $this->load->model('Settings')->all();

		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('/admin/settings/form', $data);
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
			$this->load->model('Settings')->create();
			$json['Success'] = 'Settings Has Been Created Successfully';
			$json['redirectTo'] = $this->url->link('admin/settings');
			return $this->url->redirectTo('/admin/settings');
		}else {
			// it means there are errors in form validation  
			// $json['errors'] = implode('<br>', $this->validator->getMessages());
			$json['errors'] = $this->validator->flattenMessages();

		}

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

	
}