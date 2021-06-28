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
		$constantMaker = new ConstantMaker();
        if (Secu::isConnected()) {
			header("location:/");
		}
		$user = new User();
		$view = new View('login', 'blank');

		$formLogin = $user->formLogin();

		if (!empty($_POST)) {
			$errors = FormValidator::check($formLogin, $_POST);

			if (empty($errors)) {
				$email=htmlspecialchars(strip_tags(strtolower($_POST['email'])));
				$password = stripslashes($_POST['pwd']);
				$hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');
				$FoundUser = $user->find(['email' => $email, 'pwd' => $hashed_password]);

				if ($FoundUser && $FoundUser['email'] && $FoundUser['isDeleted'] == false) {

					$token = array(
						"data" => array(
							"id" => $FoundUser['id'],
							"firstname" => $FoundUser['firstname'],
							"lastname" => $FoundUser['lastname'],
							"email" => $FoundUser['email'],
							"role" => $FoundUser['role']
						)
				 	);
					$jwt = Secu::createJwt($token);
					setcookie(
						"token",
						$jwt,
						time()+(3600*12),
						"/"
					);
					header("location:/");
				} else if ($user->getIsDeleted()) {
					$view->assign('errors', ['Account has been deleted']);
				} else {
					$view->assign('errors', ['Email or password is incorrect']);
				}
			} else {
				$view->assign('errors', $errors);
			}
		}

		$view->assign('formLogin', $formLogin);
	}

	public function register() {
		$constantMaker = new ConstantMaker();
		if (Secu::isConnected()) {
			header("location:/");
		}

		$user = new User();
		$view = new View('register', 'blank');

		$formRegister = $user->formRegister();

		if (!empty($_POST)) {
			$errors = FormValidator::check($formRegister, $_POST);

			if (empty($errors)) {
				$FoundUser = $user->find(['email' => $_POST['email']]);
				if (!$FoundUser) {
					$password = stripslashes($_POST['pwd']);
					$hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');
					$user->setFirstname($_POST['firstname']);
					$user->setLastname($_POST['lastname']);
					$user->setEmail($_POST['email']);
					$user->setPwd($hashed_password);
					$user->setCountry($_POST['country']);
					$user->save();
					$view->assign('success', "Your account has been created successfully ! \n You will automatically be redirected to the login page in 5 seconds.");
					// TODO redirect not working
					// header("Refresh:5;location:login");
					header("location:login");
				} else {
					$view->assign('errors', ['error' => 'Email is already registered']);
				}
			} else {
				$view->assign('errors', $errors);
			}
		}

		$view->assign('formRegister', $formRegister);
	}

	public function logout() {
		if (isset($_COOKIE['token'])) {
			unset($_COOKIE['token']); 
			setcookie('token', null, -1, '/');
		}
		
		// if (ini_get("session.use_cookies")) {
		// 	$params = session_get_cookie_params();
		// 	setcookie(session_name(), '', time() - 42000,
		// 		$params["path"], $params["domain"],
		// 		$params["secure"], $params["httponly"]
		// 	);
		// }
		
		header("location:login");
	}
}