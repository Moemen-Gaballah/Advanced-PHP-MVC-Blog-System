<?php
namespace App\Controllers\Admin;

use System\Controller;

class DashboardController extends Controller 
{

	public function index()
	{
		return $this->view->render('admin/main/dashboard');
	}

	public function submit()
	{
		pre($_POST);
		pre($_FILES);
		// $this->validator->required('email')->email('email');
		// $this->validator->unique('email', ['users', 'email']);
		// // $this->validator->required('email')->email('email')->unique('email', ['users', 'email']);
		// // $this->validator->required('email')->email('email')->minLen('email', 3); // TODO 
		// $this->validator->required('password')->minLen('password', 8);
		// $this->validator->match('password', 'confirm_password');
		// pre($this->validator->getMessages());

		$file = $this->request->file('image'); // UploadedFile Object
		if($file->isImage()){
		echo	$file->moveTo($this->file->to('public/uploads/images'));
		}
	}


}