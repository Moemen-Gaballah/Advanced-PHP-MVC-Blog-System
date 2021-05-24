<?php 

// white list routes

use System\Application;

$app = Application::getInstance();

$app->route->add('/', 'Home');

//  /blog/posts/my-title-post/554265
// a-z 0-9 - 
$app->route->add('/post/:text/:id', 'Posts/Post');
$app->route->add('/404', 'Error/NotFound');
$app->route->notFound('/404');
