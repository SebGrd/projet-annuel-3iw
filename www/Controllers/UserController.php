<?php

namespace App\Controllers;

use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\Message;
use App\Core\View;
use App\Models\User;

class UserController
{
    public function main() {
        $view = new View('users.main', 'admin');
        $menu = new User();
    }

    public function newUser() {
        $view = new View('users.new', 'admin');
		$user = new User();
        $form = $user->formCreateUser();

		if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);

			if (empty($errors)) {
				$foundUser = $user->find(['email' => $_POST['email']]);
				if (!$foundUser) {
					$image = Helpers::upload('users');
    
                    if (isset($image['error'])) {
                        $view->assign('errors', [$image['error']]);
                    } else {
                        $firstname = htmlspecialchars(stripslashes($_POST['firstname']));
                        $lastname = htmlspecialchars(stripslashes($_POST['lastname']));
                        $email = htmlspecialchars(stripslashes($_POST['email']));
                        $role = htmlspecialchars(stripslashes($_POST['role']));
                        if ($role == 0) $role = 'user';
                        if ($role == 1) $role = 'admin';
                        $password = htmlspecialchars(stripslashes($_POST['pwd']));
                        $hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');
                        $user->setPwd($hashed_password);
        
                        // Set all the properties of user object
                        $user->setFirstname($firstname);
                        $user->setLastname($lastname);
                        $user->setEmail($email);
                        $user->setRole($role);
                        $user->setAvatar($image !== false ? $image : null);
                        // Save to database
                        $user->save();

                        // Send email
                        $from = ['email' => MAIL_SENDER, 'name' => MAIL_NAME];
                        $to = ['email' => $_POST['email'], 'name' => $_POST['firstname']];
                        $subject = APPNAME . ' Création de votre compte';
                        $link = 'http://' . $_SERVER['HTTP_HOST'];
    
                        $email = Helpers::mailer($from, $to, $subject, ['[appname]', '[firstname]', '[email]', '[link]'], [APPNAME, $_POST['firstname'], $to['email'], $link], true, 'registered');
                        if ($email['error']) {
                            $view->assign('errors', [$email['error_message']]);
                        }
    
                        // Add success message
                        Message::add('CREATE_USER_SUCCESS');
                    }
					Message::add('UPLOAD_FILE_ERROR');
				} else {
					// Add error message
					Message::add('CREATE_USER_ERROR');

					// Reject since this email is already registered
					$view->assign('errors', ['error' => 'Cet email est déjà enregistré.']);
				}
			} else {
				// Add error message
				Message::add('CREATE_USER_ERROR');

				$view->assign('errors', $errors);
			}
		}

		$view->assign('form', $form);
    }

    public function editUser() {
        $view = new View('users.edit', 'admin');
		$user = new User();

        if (empty($_GET['id'])) {
            // Redirect to page 404 if query is malformed
            header('location: /404');
            die;
        }

        $id = htmlspecialchars(strip_tags($_GET['id']));

        if (empty($_GET['id'])) {
            // Redirect to page 404 if query is malformed
            header('location: /404');
            die;
        } else if (isset($_GET['id']) && isset($_GET['action'])) {
            // Delete if action delete is send with id
            if (ctype_digit($id)) {
                $user = $user->delete(['id' => $id]);
                header('location: /admin/users');
            } else {
                // Redirect to page 404 if query is malformed
                header('location: /404');
                die;
            }
        } else {
            // Edit
            if (ctype_digit($id)) {
                $user = $user->find(['id' => $id]);
            } else {
                // Redirect to page 404 if query is malformed
                header('location: /404');
                die;
            }
    
            if (!$user) {
                // Redirect to page 404 if user is not found
                header('location: /404');
                die;
            }
    
            if (!empty($_POST)) {  
                $image = Helpers::upload('users');
    
                if (isset($image['error'])) {
                    $view->assign('errors', [$image['error']]);
                } else {
                    $firstname = htmlspecialchars(stripslashes($_POST['firstname']));
                    $lastname = htmlspecialchars(stripslashes($_POST['lastname']));
                    $email = htmlspecialchars(stripslashes($_POST['email']));
                    $role = htmlspecialchars(stripslashes($_POST['role']));
                    if ($role == 0) $role = 'user';
                    if ($role == 1) $role = 'admin';
                    if (isset($_POST['password'])) {
                        $password = htmlspecialchars(stripslashes($_POST['pwd']));
                        $hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');
                        $user->setPwd($hashed_password);                
                    }
    
                    // Set all the properties of user object
                    $user->setFirstname($firstname);
                    $user->setLastname($lastname);
                    $user->setEmail($email);
                    $user->setRole($role);
                    $user->setAvatar($image !== false ? $image : null);
                }
            }
        }

        $form = $user->formEditUser();
        // Assign user object to the view
        $view->assign('user', $user);
        // Assign the form to the view
        $view->assign('form', $form);

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $user->save();
                Message::add('EDIT_USER_SUCCESS');
            } else {
                Message::add('EDIT_USER_ERROR');
                $view->assign('errors', $errors);
            }
		}
    }
}