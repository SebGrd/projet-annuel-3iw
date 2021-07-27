<?php

namespace App\Controllers;

use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\Message;
use App\Core\Security;
use App\Core\View;
use App\Models\User;

class SecurityController
{

	/**
	 * Login method
	 **/
	public function login()
	{
		// Redirect to home if already logged in
		if (Security::isConnected()) {
			header('location: /');
		}

		// Initialize user object & view
		$user = new User();
		$view = new View('auth.login', 'blank');

		// Get the login form
		$form = $user->formLogin();

		// If form is submitted
		if (!empty($_POST)) {
			// Validate it and store errors if any
			$errors = FormValidator::check($form, $_POST);

			// If there are no form validation errors
			if (empty($errors)) {
				// Format email & password
				$email = htmlspecialchars(strip_tags(strtolower($_POST['email'])));
				$password = stripslashes($_POST['pwd']);

				// Hash password
				$hashed_password = crypt($password, '$5$rounds=6666$' . SALT . '$');

				// Search for user by email & password and return user object if found, else return null
				$user->find(['email' => $email, 'pwd' => $hashed_password]);

				if ($user->getStatus() === 0) {
					Message::add('USER_VALIDATE_ACCOUNT_ERROR');
				} else if ($user->getId() && $user->getIsDeleted() == false) {
					// Create the jwt token
					$token = array(
						'data' => array(
							'id' => $user->getId(),
							'firstname' => $user->getFirstname(),
							'lastname' => $user->getLastname(),
							'email' => $user->getEmail(),
							'role' => $user->getRole(),
							'avatar' => $user->getAvatar()
						)
					);

					$jwt = Security::createJwt($token);

					// Set a cookie for the token that expires in 12h
					setcookie('token', $jwt, time() + (3600 * 12), '/');

					// Add success message
					Message::add('LOGIN_SUCCESS');

					// Assign success message
					$view->assign('success', 'Connexion réussie !');

					// Head to main page
					header('location: /');
				} else if ($user->getIsDeleted()) { // Reject if user is deleted
					// Add error message
					Message::add('LOGIN_ERROR');

					$view->assign('errors', ['Ce compte a été supprimé définitivement']);
				} else {
					// Reject if email or password are wrong, we don't specify which one for security purposes
					Message::add('LOGIN_ERROR');

					$view->assign('errors', ['L\'email et/ou le mot de passe sont incorrects']);
				}
			} else {
				// Assign form validation errors if there are
				$view->assign('errors', $errors);
			}
		}

		// Assign the form
		$view->assign('form', $form);
	}

	/**
	 * Register method
	 *
	 * Register a user
	 **/
	public function register()
	{
		if (Security::isConnected()) {
			header('location: /');
		}

		$user = new User();
		$view = new View('auth.register', 'blank');

		$form = $user->formRegister();

		if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);

			if (empty($errors)) {
				$foundUser = $user->find(['email' => $_POST['email']]);
				if (!$foundUser) {
					$password = htmlspecialchars(stripslashes($_POST['pwd']));
					$hashed_password = crypt($password, '$5$rounds=6666$' . SALT . '$');

					// Set all the properties of user object
					$user->setFirstname($_POST['firstname']);
					$user->setLastname($_POST['lastname']);
					$user->setEmail($_POST['email']);
					$user->setPwd($hashed_password);
					// Save to database
					$user->save();

					// Send email
					$from = ['email' => MAIL_SENDER, 'name' => MAIL_NAME];
					$to = ['email' => $_POST['email'], 'name' => $_POST['firstname']];
					$subject = APPNAME . ' Création de votre compte';
					$link = 'http://' . $_SERVER['HTTP_HOST'];

					$token = array(
						'data' => array(
							'email' => $user->getEmail()
						)
					);

					$jwt = Security::createJwt($token);

					$confirm_link = $link . '/register?token=' . $jwt;

					$email = Helpers::mailer($from, $to, $subject, ['[appname]', '[firstname]', '[email]', '[link]', '[confirm_link]'], [APPNAME, ucfirst($_POST['firstname']), $to['email'], $link, $confirm_link], true, 'registered');
					if ($email['error']) {
						$view->assign('errors', [$email['error_message']]);
					}

					// Add success message
					Message::add('REGISTER_SUCCESS');

					header('Refresh:1; url=/login', true, 303);
				} else {
					// Add error message
					Message::add('REGISTER_ERROR');

					// Reject since this email is already registered
					$view->assign('errors', ['error' => 'Cet email est déjà inscrit']);
				}
			} else {
				// Add error message
				Message::add('REGISTER_ERROR');

				$view->assign('errors', $errors);
			}
		}

		if (!empty($_GET['token'])) {
			$token = htmlspecialchars(stripslashes($_GET['token']));
			$decoded_token = Security::decodeJwt($token);
			if (is_object($decoded_token)) {
				$user->find(['email' => $decoded_token->data->email]);
				if ($user->getStatus() === 0) {
					$user->setStatus(1);
					$user->save();
					Message::add('USER_EMAIL_ACTIVATED');
					header("Refresh:5; url=/login", true, 303);
				} else {
					header('location:login');
				}
			}
		}

		$view->assign('form', $form);
	}

	/**
	 * Logout method
	 *
	 * Log a user out
	 **/
	public function logout($delay = 0)
	{
		// If already logged in, delete the token cookie and head to login page
		if (isset($_COOKIE['token'])) {
			unset($_COOKIE['token']);
			unset($_COOKIE['userStore']);
			setcookie('token', null, -1, '/');
		}

		header("Refresh:$delay; url=/login");
	}

	/**
	 * Reset password method
	 *
	 * Reset a user's password
	 **/
	public function resetPassword()
	{
		if (Security::isConnected()) {
			header('location: /');
		}

		$user = new User();
		$view = new View('auth.forgotPassword', 'blank');

		$formResetPassword = $user->formResetPassword();
		$formNewPassword = $user->formNewPassword();

		if (!empty($_POST) && empty($_GET)) {
			$errors = FormValidator::check($formResetPassword, $_POST);

			if (empty($errors)) {
				$user->find(['email' => $_POST['email']]);

				if ($user->getId()) {
					$token = [
						'data' => [
							'email' => $user->getEmail()
						]
					];
					$passwordResetToken = Security::createJwt($token);
					$user->setPwdResetToken($passwordResetToken);
					$user->save();

					// Send email
					$from = ['email' => MAIL_SENDER, 'name' => MAIL_NAME];
					$to = ['email' => $_POST['email'], 'name' => ''];
					$subject = 'Réinitialisation de mot de passe';
					$link = 'http://localhost/forgot-password?token=' . $passwordResetToken;

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
						$hashed_password = crypt($password, '$5$rounds=6666$' . SALT . '$');
						$user->setPwd($hashed_password);
						$user->setPwdResetToken('');
						$user->save();
						$view->assign('success', "Votre nouveau mot de passe a bien été enregistré, vous allez être redirigé sur la page de connexion dans quelques instants.");
						header("Refresh:5; url=http://" . $_SERVER['HTTP_HOST'] . "/login", true, 303);
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

	/**
	 * Profile method
	 *
	 * Show a user's profile
	 **/
	public function profile()
	{
		$user = new User();
		$view = new View('profile', 'blank');

		$form = $user->formEditProfile();

		if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);

			if (empty($errors)) {
				$user->find(['id' => $_SESSION['userStore']->id]);

				if ($user->getId()) {
					$image = Helpers::upload('users');

					if (isset($image['error'])) {
						$view->assign('errors', [$image['error']]);
					} else {
						$firstname = htmlspecialchars(stripslashes($_POST['firstname']));
						$lastname = htmlspecialchars(stripslashes($_POST['lastname']));
						$email = htmlspecialchars(stripslashes($_POST['email']));
						if (isset($_POST['password'])) {
							$password = htmlspecialchars(stripslashes($_POST['pwd']));
							$hashed_password = crypt($password, '$5$rounds=6666$' . SALT . '$');
							$user->setPwd($hashed_password);
						}
						$user->setFirstname($firstname);
						$user->setLastname($lastname);
						$user->setEmail($email);
						if ($image !== false) {
							$user->setAvatar($image);
						}
						$user->save();

						Message::add('EDIT_PROFILE_SUCCESS');

						$data = $user->find(['id' => $user->getId(), 'isDeleted' => 0], ['id' => 'ASC'], true);
						$_SESSION['userStore'] = $data;
					}
				} else {
					Message::add('EDIT_PROFILE_ERROR');
				}
			} else {
				Message::add('EDIT_PROFILE_ERROR');
				$view->assign('errors', $errors);
			}
		}

		if (isset($_GET['delete'])) {
			$this->deleteAccount();
		}

		$data = $_SESSION['userStore'];

		$view->assign('form', $form);
		$view->assign('user', (object) $data);
	}

	public function deleteAccount() {
		$user = new User();

		if (!empty($_GET['token'])) {
			$token = htmlspecialchars(stripslashes($_GET['token']));
			$decoded_token = Security::decodeJwt($token);
			if (is_object($decoded_token)) {
				$user->find(['email' => $decoded_token->data->email]);
				if ($user->getIsDeleted() === 0 && $user->getStatus() !== 0) {
					$user->setIsDeleted(1);
					$user->save();
					$this->logout();
					Message::add('USER_ACCOUNT_DISABLED');
					header("Refresh:5; url=/login", true, 303);
				} else {
					header('location:login');
				}
			} else {
				header('location:login');
			}
		} else {
			$user->find(['id' => $_SESSION['userStore']->id]);

			$token = [
				'data' => [
					'email' => $user->getEmail()
				]
			];
			$deleteToken = Security::createJwt($token);

			// Send email
			$from = ['email' => MAIL_SENDER, 'name' => MAIL_NAME];
			$to = ['email' => $user->getEmail(), 'name' => ''];
			$subject = APPNAME . ' Suppression de votre compte';
			$link = 'http://localhost/delete-my-account?token=' . $deleteToken;
			$firstname = $user->getFirstname();

			$email = Helpers::mailer($from, $to, $subject, ['[appname]', '[email]', '[link]', '[firstname]'], [APPNAME, $to['email'], $link, $firstname], true, 'deleteAccount');
			if ($email['error']) {
				header('location:login');
			} else {
				Message::add('USER_ACCOUNT_DISABLED_EMAIL');
			}
		}
	}
}
