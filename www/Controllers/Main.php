<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\Helpers;

class Main {
	public function default() {
		$view = new View('home');
		
		$view->assign('username', 'toto');
		$view->assign('age', 18);
		$view->assign('email', 'john.doe@gmail.com');
	}
}