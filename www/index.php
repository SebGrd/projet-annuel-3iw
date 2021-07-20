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

// Get the current route properties
$router = new Router($uri);

/* DONE
 * render error view on die
 * put routing in App\Core\Router
*/

/* TODO
 * replace 'if' by 'since' in comments when necessary
 * repopulate form fields after validation error
 * render error view without changing the URL to 404
*/