<?php

namespace App\Controllers;
use App\Core\View;

class MainController {
	public function home() {
		$view = new View('home', 'front');

	}

	public function notFound($error = 'Erreur') {
		$view = new View('404', 'blank');
		$view->assign('error', $error);
	}
}