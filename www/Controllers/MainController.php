<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\Database;

class MainController {
	public function home() {
		$view = new View('home', 'front');

	}

	public function notFound($error = 'Erreur') {
		$view = new View('404', 'blank');
		$view->assign('error', $error);
	}
}