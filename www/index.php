<?php

namespace App;
use App\Core\Router;
use App\Core\Security;
use App\Core\ConstantMaker;
require 'Autoload.php';

Autoload::register();
session_start();

$constantMaker = new ConstantMaker();

(ENV == 'dev')
? ini_set('display_errors', 1)
: ini_set('display_errors', 0);

$uriExploded = explode('?', $_SERVER['REQUEST_URI']);
$uri = $uriExploded[0];

// $_SESSION['title'] = 'HEY';

// Get the current route properties
$router = new Router($uri);

/* DONE
 * render error view on die
 * put routing in App\Core\Router
 * repopulate form fields after validation error
 * render error view without changing the URL to 404
 * render page html at '/page?id=' and add actions
*/

/* TODO
 * replace 'if' by 'since' in comments when necessary
 * /favicon.ico
 * /sitemap.xml
 * SEO
 * deploy it on a server
*/