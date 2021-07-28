<?php

namespace App;
use App\Core\Router;
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

// Get the current route properties
$router = new Router($uri);

/* TODO
 * /favicon.ico
 * /sitemap.xml
 * SEO
*/