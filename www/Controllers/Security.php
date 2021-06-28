<?php

namespace App\Controllers;

use App\Core\Security as Secu;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker;

use App\Models\User;

class Security {

	public function login() {
		$constantMaker = new ConstantMaker();
        if (Secu::isConnected()) {
			header("location:/");
		}
		$user = new User();
		$view = new View('login', 'blank');

		$form = $user->formLogin();

		if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);

			if (empty($errors)) {

				$email = htmlspecialchars(strip_tags(strtolower($_POST['email'])));

				$password = stripslashes($_POST['pwd']);
				$hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');

				$user->find(['email' => $email, 'pwd' => $hashed_password]);

				if ($user->getId() && $user->getIsDeleted() == false) {

					$token = array(
						"data" => array(
							"id" => $user->getId(),
							"firstname" => $user->getFirstName(),
							"lastname" => $user->getLastName(),
							"email" => $user->getEmail(),
							"role" => $user->getRole(),
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

		$view->assign('form', $form);
	}

	public function register() {
		$constantMaker = new ConstantMaker();
		if (Secu::isConnected()) {
			header("location:/");
		}

		$user = new User();
		$view = new View('register', 'blank');

		$form = $user->formRegister();

		if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);

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

		$view->assign('form', $form);
	}

	public function logout() {
		if (isset($_COOKIE['token'])) {
			unset($_COOKIE['token']); 
			setcookie('token', null, -1, '/');
		}
		
		header("location:login");
	}

	public function resetPassword() {
		$constantMaker = new ConstantMaker();
		if (Secu::isConnected()) {
			header("location:/");
		}
		$user = new User();
		$view = new View('forgotPassword', 'blank');

		$formResetPassword = $user->formResetPassword();
		$formNewPassword = $user->formNewPassword();
		
		if (!empty($_POST) && empty($_GET)) {
			$errors = FormValidator::check($formResetPassword, $_POST);

			if (empty($errors)) {

				$user->find(['email' => $_POST['email']]);

				if ($user->getId()) {
					$passwordResetToken = bin2hex(random_bytes(20));
					$user->setPwdResetToken($passwordResetToken);
					$user->save();

					// Send email
					$to = $_POST['email'];
					$subject = 'Réinitialisation de mot de passe';
					$message = `Bonjour,\r\nVeuillez cliquez <a href="http://localhost:8888/forgot-password?token=$passwordResetToken">ici</a> pour changer de mot de passe.`;
					$headers = array(
						'From' => 'hello@cms.fr',
						'MIME-Version' =>  '1.0',
						'Content-type' =>  'text/html; charset=iso-8859-1'
					);

					mail($to, $subject, $message, $headers);

					$view->assign('success', "Un email viens de vous être envoyé, cliquez sur le lien dans l'email pour réinitialiser votre mot de passe. \n vous pouvez fermer cette page.");
				} else {
					// On envoie le même message pour eviter le brute force pour trouver des emails existant.
					$view->assign('success', "Un email viens de vous être envoyé, cliquez sur le lien dans l'email pour réinitialiser votre mot de passe. \n vous pouvez fermer cette page.");
				}
			} else {
				$view->assign('errors', $errors);
			}
		}

		if (!empty($_GET)) {
			$token = htmlspecialchars(stripslashes($_GET['token']));

			$user->find(['pwdResetToken' => $token]);

			if ($user->getId()) {
				if (!empty($_POST)) {
					$errors = FormValidator::check($formNewPassword, $_POST);
					if (empty($errors)) {
						$password = stripslashes($_POST['pwd']);
						$hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');
						$user->setPwd($hashed_password);
						$user->setPwdResetToken('');
						$user->save();
						$view->assign('success', "Votre nouveau mot de passe a bien été enregistré, vous pouvez maintenant vous connecter avec.");
					} else {
						$view->assign('errors', $errors);
					}
				}
			} else {
				header('location:login');
			}
			
			$view->assign('formNewPassword', $formNewPassword);
		} else {
			$view->assign('formResetPassword', $formResetPassword);
		}

	}
}