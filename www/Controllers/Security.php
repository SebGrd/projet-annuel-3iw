<?php

namespace App\Controllers;

use App\Core\Security as Secu;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker;

use App\Models\User;

class Security {
	public function default() {
		$a = explode('\\', __METHOD__);
		echo end($a).' called';
	}

	public function login() {
		$a = explode('\\', __METHOD__);
		echo end($a).' called';
	}

	public function register() {
		// $a = explode('\\', __METHOD__);
		// echo end($a).' called';

		// $user = new User();
		// $user->setFirstname('John');
		// $user->setLastname('DOE');
		// $user->setEmail('john.doe@gmail.com');
		// $user->setPwd('johndoe');
		// $user->setCountry('en');
		// $user->save();

		// $log = new Log();
		// $log->user('john.doe@gmail.com');
		// $log->date(time());
		// $log->success(false);
		// $log->save();

		// $user = new User();
		// print_r($user); // empty
		// $user->setId(2); // populate object with user 
		// print_r($user); // return user
		// $user->setFirstname('Jane');
		// $user->setEmail('jane.doe@gmail.com');
		// $user->setPwd('janedoe');		
		// $user->save();

		// FIXME unloaded constants -> I added this line -> #1
		$constantMaker = new ConstantMaker();

		$user = new User();
		$view = new View('register');

		$form = $user->formRegister();
		$formLogin = $user->formLogin();

		if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);

			if (empty($errors)) {
				$user->setFirstname($_POST['firstname']);
				$user->setLastname($_POST['lastname']);
				$user->setEmail($_POST['email']);
				$user->setPwd($_POST['pwd']);
				$user->setCountry($_POST['country']);
				$user->save();
			} else {
				$view->assign('errors', $errors);
			}
		}

		$view->assign('form', $form);
		$view->assign('formLogin', $formLogin);
	}

	public function logout() {
		// $a = explode('\\', __METHOD__);
		// echo end($a).' called';
		// echo '<br>';

		$security = new Secu();

		if ($security->isConnected()) {
			echo 'Logged out!';
			// TODO log out current user
		} else {
			echo 'Already logged out';
			// TODO redirect to previous uri
		}
	}
}