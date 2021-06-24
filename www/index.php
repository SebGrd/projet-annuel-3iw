<?php

namespace App;
use App\Core\Router;
use App\Core\Security;
require 'Autoload.php';

ini_set('display_errors', 1);

Autoload::register();
session_start();

$uriExploded = explode('?', $_SERVER['REQUEST_URI']);
$uri = $uriExploded[0];

if (!Security::isConnected()) {
	if ($uri !== "/login" && $uri !== "/register") {
		header("location:login");
	}
}

$router = new Router($uri);
$c = $router->getController();
$a = $router->getAction();

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