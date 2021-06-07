<?php

namespace App;
use App\Core\Router;
require 'Autoload.php';
Autoload::register();

$uriExploded = explode('?', $_SERVER['REQUEST_URI']);
$uri = $uriExploded[0];
$router = new Router($uri);
$c = $router->getController();
$a = $router->getAction();

// echo "Controller: ".$c."<br>Action: ".$a."<br><br>";

if (file_exists("Controllers/$c.php")) {
	include "Controllers/$c.php";
	$c = "App\\Controllers\\$c";
		if (class_exists($c)) {
		$cObjet = new $c();
		if (method_exists($cObjet, $a)) {
			$cObjet->$a();
		} else { die("404: Action $c: $a not found"); }
	} else { die("404: Controller $c not found"); }
} else { die("404: File $c.php not found"); }

// TODO render error view on die