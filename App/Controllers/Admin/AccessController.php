<?php
namespace App\Controllers\Admin;

use System\Controller;

class AccessController extends Controller
{
	/**
	* Check User Permissions to access admin pages 
	*
	* @return void
	*/ 
	public function index()
	{	
		$loginModel = $this->load->model('Login');

		$ignoredPages = ['/admin/login', '/admin/login/submit'];

		$currentRoute = $this->route->getCurrentRouteUrl();



		// if(! $loginModel->isLogged() && ! in_array($currentRoute, $ignoredPages))
		// {
		// 	return $this->url->redirectTo('/admin/login');
		// }



		if(! $loginModel->isLogged() && ! in_array($currentRoute, $ignoredPages))
		{
			return $this->url->redirectTo('/admin/login');
		}elseif (in_array($currentRoute, $ignoredPages)) {
			return true;
		}
		// dd(in_array($currentRoute, $ignoredPages));
		$user = $loginModel->user();
		$usersGroupsModel = $this->load->model('UsersGroups');

		$usersGroup = $usersGroupsModel->get($user->users_group_id);

		// Id url post/edit/id 
		if(is_int($idForUrl =basename($this->request->url())))
		{
			$urlForId = str_replace($idForUrl,":id",$currentRoute);
			if (! in_array($urlForId, $usersGroup->pages)){
				// TODO we may create page to access denied page
				return $this->url->redirectTo('/');
			}else {
				return ;
			}
		

			if (! in_array($currentRoute, $usersGroup->pages)) {
				// TODO we may create page to access denied page
				return $this->url->redirectTo('/');
			}
		}
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