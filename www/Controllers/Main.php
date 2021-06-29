<?php

namespace App\Controllers;
use App\Core\View;

class Main {
	public function home() {
		// if (Security::isConnected()) {
		// 	$template = 'front';
		// }

		$view = new View('home', $template ?? 'front');
		
		$view->assign('username', 'toto');
		$view->assign('age', 18);
		$view->assign('email', 'john.doe@gmail.com');
	}
}