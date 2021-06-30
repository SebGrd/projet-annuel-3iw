<?php

namespace App\Controllers;

use App\Core\Security;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker;

use App\Models\User;

class SecurityController {

	public function login() {
		// Initialize the constants
		$constantMaker = new ConstantMaker();

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
		$constantMaker = new ConstantMaker();
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
					$view->assign('success', "Your account has been created successfully ! \n You will automatically be redirected to the login page in 5 seconds.");

					header("location:login"); // Todo redirect after 5 seconds
				} else { // Reject if email is registered
					$view->assign('errors', ['error' => 'Email is already registered']);
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
		$constantMaker = new ConstantMaker();
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