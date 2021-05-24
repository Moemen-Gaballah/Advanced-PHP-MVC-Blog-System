<?php
namespace App\Controllers;

use System\Controller;
use System\Database;

class HomeController extends Controller 
{

	// public function __construct(Application $app){
	// 	parent::__construct();
	// 	echo "Home Controller<br>";
	// }

	public function index()
	{
		// echo $this->url->link('home');
		echo assets('images/logo.png');
		
		// $this->url->redirectTo('/home/');

		// $users = $this->load->model('Users');
		// pre($users->all());
		// pre($users->get('1'));

	}

	// public function index()
	// {
		// $this->db;
		// $db = new Database($this->app);
		
		// $data['myName'] = 'Moemen';
		// $this->view->render('home', $data);

		// $this->db->data([
		// 	'name' => 'hassan',
		// 	'age' => 13,
		// ])->Insert('users');
	
		// $this->db->query('INSERT INTO users SET 
		// 	first_name=? , 
		// 	last_name=? , 
		// 	email=? , 
		// 	password=? , 
		// 	gender=? , 
		// 	status=?' , 'moemen', 'gaballa', 'moemen@gmail.com', '123456', 'male', 'enabled');

		// // insert user
		// echo $this->db->data([
		// 	'first_name' => 'mohsen',
		// 	'last_name' => 'anwer',
		// 	'email' => 'mohsen@gmail.com',
		// 	'password' => 123456,
		// 	'gender' => 'male',
		// 	'status' => 'enabled',
		// ])->insert('users')->lastId();

		// // Get user
		// $user = $this->db->query('SELECT * FROM users WHERE id = ?', 4)->fetch();
		// pre($user);

		// update user 
		// $this->db->data('email', 'moemenupdate12345@gmail.com')->where('id = ?', 1)->update('users');

			// $this->db->data('first_name', 'testfirstname')->update('users');

		// $user = $this->db->select('*')->from('users')->orderBy('id', 'DESC')->fetch();

		// $users = $this->db->select('*')->from('users')->orderBy('id')->fetchAll();
		
		// $users = $this->db->select('*')->from('users')->where('id > ? AND id < ?', 1, 4)->orderBy('id')->fetchAll();

		// DELETE
		// $this->db->where('id > ? AND id < ?',1, 4)->delete('users');

	// 	pre($this->db->where('id != ?', 4)->fetchAll('users'));
	// 	pre($this->db->rows());
	// 	pre($this->db->fetchAll('users'));
	// }
}