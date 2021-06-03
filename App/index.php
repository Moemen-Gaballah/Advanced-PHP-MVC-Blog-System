<?php 

// white list routes

use System\Application;

$app = Application::getInstance();

if (strpos($app->request->url(), '/admin') === 0 ) {
	// check if the current url started with /admin


	$app->route->callFirst(function ($app) {
		// if so, then call out middlewares
		$app->load->action('Admin/Access', 'index');
	});
}



$app->route->add('/', 'Home');
// Admin Routes 
$app->route->add('/admin/login', 'Admin/Login');
$app->route->add('/admin/login/submit', 'Admin/Login@submit', 'POST');

// share admin Layout
$app->share('adminLayout', function ($app) {
	return $app->load->controller('Admin/Common/Layout');
});

// Logout 
$app->route->add('/admin/logout', 'Admin/Logout');


// dashboard 
$app->route->add('/admin', 'Admin/Dashboard');
$app->route->add('/admin/dashboard', 'Admin/Dashboard');
$app->route->add('/admin/submit', 'Admin/Dashboard@submit', 'POST');

// admin => users 
$app->route->add('/admin/users', 'Admin/Users');
$app->route->add('/admin/users/add', 'Admin/Users@add');
$app->route->add('/admin/users/submit', 'Admin/Users@submit', 'POST');
$app->route->add('/admin/users/edit/:id', 'Admin/Users@edit');
$app->route->add('/admin/users/save/:id', 'Admin/Users@save', 'POST');
$app->route->add('/admin/users/delete/:id', 'Admin/Users@delete');

// admin => user profile
$app->route->add('/admin/profile', 'Admin/Profile'); 
$app->route->add('/admin/profile/update', 'Admin/Profile@update', 'POST'); 


// admin => users-groups 
$app->route->add('/admin/users-groups', 'Admin/UsersGroups');
$app->route->add('/admin/users-groups/add', 'Admin/UsersGroups@add');
$app->route->add('/admin/users-groups/submit', 'Admin/UsersGroups@submit', 'POST');
$app->route->add('/admin/users-groups/edit/:id', 'Admin/UsersGroups@edit');
$app->route->add('/admin/users-groups/save/:id', 'Admin/UsersGroups@save', 'POST');
$app->route->add('/admin/users-groups/delete/:id', 'Admin/UsersGroups@delete');



// admin => categories  Categories
$app->route->add('/admin/categories', 'Admin/Categories');
$app->route->add('/admin/categories/add', 'Admin/Categories@add');
$app->route->add('/admin/categories/submit', 'Admin/Categories@submit', 'POST');
$app->route->add('/admin/categories/edit/:id', 'Admin/Categories@edit');
$app->route->add('/admin/categories/save/:id', 'Admin/Categories@save', 'POST');
$app->route->add('/admin/categories/delete/:id', 'Admin/Categories@delete');



// admin => posts 
$app->route->add('/admin/posts', 'Admin/Posts');
$app->route->add('/admin/posts/add', 'Admin/Posts@add');
$app->route->add('/admin/posts/submit', 'Admin/Posts@submit', 'POST');
$app->route->add('/admin/posts/edit/:id', 'Admin/Posts@edit');
$app->route->add('/admin/posts/save/:id', 'Admin/Posts@save', 'POST');
$app->route->add('/admin/posts/delete/:id', 'Admin/Posts@delete');

// Admin => Comments
$app->route->add('/admin/posts/:id/comments', 'Admin/Comments');
$app->route->add('/admin/comments/edit/:id', 'Admin/Comments@edit');
$app->route->add('/admin/comments/save/:id', 'Admin/Comments@save', 'POST');
$app->route->add('/admin/comments/delete/:id', 'Admin/Comments@delete');


// Admin Settings
 $app->route->add('/admin/settings', 'Admin/Settings');
 $app->route->add('/admin/settings/save', 'Admin/Settings@save', 'POST');


 // Admin Contacts
 $app->route->add('/admin/contacts', 'Admin/contacts');
 $app->route->add('/admin/contacts/reply/:id', 'Admin/contacts@reply');
 $app->route->add('/admin/contacts/send/:id', 'Admin/contacts@send', 'POST');


// admin => ads 
$app->route->add('/admin/ads', 'Admin/Ads');
$app->route->add('/admin/ads/add', 'Admin/Ads@add');
$app->route->add('/admin/ads/submit', 'Admin/Ads@submit', 'POST');
$app->route->add('/admin/ads/edit/:id', 'Admin/Ads@edit');
$app->route->add('/admin/ads/save/:id', 'Admin/Ads@save', 'POST');
$app->route->add('/admin/ads/delete/:id', 'Admin/Ads@delete');



// Not Found Routes
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');
