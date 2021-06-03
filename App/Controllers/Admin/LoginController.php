<?php
namespace App\Controllers\Admin;

use System\Controller;

class LoginController extends Controller
{
	/**
	* Display Login Form
	*
	* @return mixed
	*/ 
	public function index()
	{	
		pre($this->cookie->get('login'));
		$loginModel = $this->load->model('Login');
		// pre($this->session->get('login'));
		pred('awadwa');
		dd($loginModel->isLogged());
		if($loginModel->isLogged() === true){
		// dd($loginModel->isLogged());
			return $this->url->redirectTo('/admin');
		}
		$data['errors'] = $this->errors;
		return $this->view->render('admin/users/login', $data);
	}

	/**
	* Submit Login form
	*
	* @return mixed
	*/
	public function submit()
	{
		if($this->isValid()) {
			$loginModel = $this->load->model('Login');
			// pre($loginModel->user());

			$loggedInUser = $loginModel->user();
			if ($this->request->post('remember'))
			{
				// save login data in cookie
				$this->cookie->set('login', $loggedInUser->code);
			} else {
				// save login data in session
				$this->session->set('login', $loggedInUser->code);
			}
	
			// return $this->url->redirectTo('/admin');
			$json = [];
			$json['success'] = 'Welcome Back <b> ' . $loggedInUser->first_name . ' ' . $loggedInUser->last_name . '</b>';

			$json['redirect'] = $this->url->link('/admin');

			// return json_encode($json);
			return $this->json($json); 
		}else{
			// return $this->index();
			$json = [];
			$json['errors'] = implode('<br>', $this->errors);
			// $json['errors'] = $this->errors;
			return $this->json($json); 
		}

	}

	
	/**
	* Validate Login Form
	*
	* @return bool
	*/
	private function isValid()
	{
		$email = $this->request->post('email');
		$password = $this->request->post('password');

		if(! $email) {
			$this->errors[] = 'Please Insert Email Address';
		}elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->errors[] = 'Please Insert Valid Email';
		}

		if(! $password) {
			$this->errors[] = 'Please Insert Password';
		}

		if(! $this->errors) {
			$loginModel = $this->load->model('Login');

			if(! $loginModel->isValidLogin($email, $password))
			{
				$this->errors[] = 'Invalid Login Data';
			}
		}

		return empty($this->errors);

	} // End method is valid
}