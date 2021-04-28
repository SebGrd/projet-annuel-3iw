<?php

namespace App\Controllers;
use App\Core\View;

class Main {
	public function default() {
		// $a = explode('\\', __METHOD__);
		// echo end($a).' called';
		$view = new View('home');
		$view->assign('username', 'John DOE');
		$view->assign('age', 18);
		$view->assign('email', 'john.doe@gmail.com');
	}
}