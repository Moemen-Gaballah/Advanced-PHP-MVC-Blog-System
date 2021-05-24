<?php 

require __DIR__ . '/vendor/System/Application.php';
require __DIR__ . '/vendor/System/File.php';

use System\File;
use System\Application;
$file = new File(__DIR__);
	
// $app = new Application(new File(__DIR__)); //meaning  indepency injection
// $app = new Application($file);
$app = Application::getInstance($file);
$app->run();