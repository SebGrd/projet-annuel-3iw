<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker;
use App\Core\Helpers;
use App\Models\User;

class SecurityController {

	public function __construct() {
		// Initialize the constants
		$constantMaker = new ConstantMaker();
	}

	public function login() {
		if (Security::isConnected()) {
			header("location:/");
		}

		// Initialize user object & view
		$user = new User();
		$view = new View('login', 'blank');

		// Get the login form
		$form = $user->formLogin();

		// When form is submitted
		if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);

			if (empty($errors)) {

				// Format email & password
				$email = htmlspecialchars(strip_tags(strtolower($_POST['email'])));
				$password = stripslashes($_POST['pwd']);
				// Hash password
				$hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');

				// Search for user by email & password, if found return user object else return null
				$user->find(['email' => $email, 'pwd' => $hashed_password]);

				// If user is found & user is not deleted
				if ($user->getId() && $user->getIsDeleted() == false) {

					// create the jwt token
					$token = array(
						"data" => array(
							"id" => $user->getId(),
							"firstname" => $user->getFirstName(),
							"lastname" => $user->getLastName(),
							"email" => $user->getEmail(),
							"role" => $user->getRole(),
						)
				 	);
					$jwt = Security::createJwt($token);

					// Set the cookie for the token
					setcookie(
						"token",
						$jwt,
						time()+(3600*12),
						"/"
					);

					// Head to main page
					header("location:/");

				} else if ($user->getIsDeleted()) { // Reject if user is deleted
					$view->assign('errors', ['Ce compte à été définitivement supprimé']);
				} else { // Reject if email or password is wrong, we don't say which one is wrong for security purposes
					$view->assign('errors', ['L\'email et/ou le mot de passe sont incorrects']);
				}
			} else { // Assign formValidator Errors if set
				$view->assign('errors', $errors);
			}
		}
		$view->assign('form', $form); // Assign the form to the view
	}

	public function register() {
		if (Security::isConnected()) {
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

					// Set all the properties of user object
					$user->setPwd($hashed_password);
					$user->setFirstname($_POST['firstname']);
					$user->setLastname($_POST['lastname']);
					$user->setEmail($_POST['email']);
					$user->setUpdatedAt(date('Y-m-d H:i:s'));
					// Save to database
					$user->save();
					$view->assign('success', "Votre compte a été créé avec succès ! \n Vous pouvez désormais vous connecter.");
					// Send email
					$from = ['email' => MAIL_SENDER, 'name' => MAIL_NAME];
					$to = ['email' => $_POST['email'], 'name' => $_POST['firstname']];
					$subject = APPNAME . ' Création de votre compte';
					$link = 'http://' . $_SERVER['HTTP_HOST'];

					$email = Helpers::mailer($from, $to, $subject, ['[appname]', '[firstname]', '[email]', '[link]'], [APPNAME, $_POST['firstname'], $to['email'], $link], true, 'registered');
					if ($email['error']) {
						$view->assign('errors', [$email['error_message']]);
					}

					header( "Refresh:5; url=http://" . $_SERVER['HTTP_HOST'] . "/login", true, 303);
				} else { // Reject if email is registered
					$view->assign('errors', ['error' => 'Cet email est déjà inscrit']);
				}
			} else {
				$view->assign('errors', $errors);
			}
		}
		$view->assign('form', $form);
	}

	public function logout() {
		// If user is logged in, delete the token cookie & head to login page
		if (isset($_COOKIE['token'])) {
			unset($_COOKIE['token']); 
			setcookie('token', null, -1, '/');
		}
		header("location:login");
	}

	public function resetPassword() {
		if (Security::isConnected()) {
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
					$token = array(
						"data" => array(
							"email" => $user->getEmail()
						)
				 	);
					$passwordResetToken = Security::createJwt($token);
					$user->setPwdResetToken($passwordResetToken);
					$user->save();

					// Send email
					$from = ['email' => MAIL_SENDER, 'name' => MAIL_NAME];
					$to = ['email' => $_POST['email'], 'name' => ''];
					$subject = 'Réinitialisation de mot de passe';
					$link = 'http://localhost:8888/forgot-password?token=' . $passwordResetToken;

					$email = Helpers::mailer($from, $to, $subject, ['[appname]', '[email]', '[link]'], [APPNAME, $to['email'], $link], true, 'forgotPassword');
					if ($email['error']) {
						$view->assign('errors', [$email['error_message']]);
					} else {
						$view->assign('success', "Un email viens de vous être envoyé, cliquez sur le lien dans l'email pour réinitialiser votre mot de passe. \n vous pouvez fermer cette page.");
					}
				} else {
					// On renvoie le même message pour eviter le brut force permettant de trouver des emails enregistré.
					$view->assign('success', "Un email viens de vous être envoyé, cliquez sur le lien dans l'email pour réinitialiser votre mot de passe. \n vous pouvez fermer cette page.");
				}
			} else {
				$view->assign('errors', $errors);
			}
		}

		if (!empty($_GET)) {
			$token = htmlspecialchars(stripslashes($_GET['token']));
			$decoded_token = Security::decodeJwt($token);
			if (is_object($decoded_token)) {
				$user->find(['pwdResetToken' => $token]);
			}

			if ($user->getId()) {
				if (!empty($_POST)) {
					$errors = FormValidator::check($formNewPassword, $_POST);
					if (empty($errors)) {
						$password = stripslashes($_POST['pwd']);
						$hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');
						$user->setPwd($hashed_password);
						$user->setPwdResetToken('');
						$user->save();
						$view->assign('success', "Votre nouveau mot de passe a bien été enregistré, vous allez être redirigé sur la page de connexion dans quelques instants.");
						header( "Refresh:5; url=http://" . $_SERVER['HTTP_HOST'] . "/login", true, 303);
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