<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\Product;

class MainController {
	public function home() {
	    $Product = new Product();
	    $products = $Product->findAll([], [], true);
		$view = new View('home', 'front');
		$view->assign('products', $products);
	}

	public function notFound($error = 'Erreur') {
		$view = new View('404', 'blank');
		$view->assign('error', $error);
	}
}