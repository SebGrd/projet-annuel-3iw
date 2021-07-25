<?php

namespace App\Controllers;

use App\Core\ConstantMaker;
use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\Message;
use App\Core\Session;
use App\Core\View;
use App\Models\Menu;

class MenuController
{
    public function __construct() {
		$constantMaker = new ConstantMaker();
    }

    public function main() {
        $view = new View('menus.main', 'admin');
		$menu = new Menu();
    }

    public function newMenu() {
        $view = new View('menus.new', 'admin');
		$menu = new Menu();
        $form = $menu->formMenu();

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $title = htmlspecialchars(strip_tags($_POST['title']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
    
                $menu->find(['title' => $title]);
    
                if ($menu->getId()) {
                    $view->assign('errors', ["Le menu $title existe déjà"]);
                } else {
                    $image = Helpers::upload('menus');

                    if (isset($image['error'])) {
                        $view->assign('errors', [$image['error']]);
                    } else {
                        // Create and save the menu
                        $menu->setTitle($title);
                        $menu->setDescription($description);
                        $menu->setImage($image !== false ? $image : null);
                        $menu->save();
                        $view->assign('success', "Le menu $title a été créé");

    					Message::add('NEW_MENU_SUCCESS');
                    }
                }
            } else {
                $view->assign('errors', $errors);
            }
		}

		$view->assign('form', $form);
    }

    public function editMenu() {
        $view = new View('menus.edit', 'admin');
		$menu = new Menu();

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
                $menu = $menu->delete(['id' => $id]);
                header('location: /admin/menus');
            } else {
                // Redirect to page 404 if query is malformed
                header('location: /404');
                die;
            }
        } else {
            // Edit
            // Check if id is an integer
            if (ctype_digit($id)) {
                $menu = $menu->find(['id' => $id]);
            } else {
                // Redirect to page 404 if query is malformed
                header('location: /404');
                die;
            }
    
            if (!$menu) {
                // Redirect to page 404 if menu is not found
                header('location: /404');
                die;
            }
    
            if (!empty($_POST)) {
                $title = htmlspecialchars(strip_tags($_POST['title']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
    
                $image = Helpers::upload('menus');
    
                if (isset($image['error'])) {
                    $view->assign('errors', [$image['error']]);
                } else {
                    $menu->setTitle($title);
                    $menu->setDescription($description);
                    $menu->setImage($image !== false ? $image : null);
                }
            }
        }

        $form = $menu->formMenu();
        // Assign menu object to the view
        $view->assign('menu', $menu);
        // Assign the form to the view
        $view->assign('form', $form);

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $menu->save();
                $view->assign('success', "Le menu $title a bien été mis à jour");

                Message::add('EDIT_MENU_SUCCESS');
            } else {
                $view->assign('errors', $errors);
            }
		}
    }

    public function deleteMenu() {
		$menu = new Menu();

        if (empty($_GET['id'])) {
            // Redirect to page 404 if query is malformed
            header('location: /404');
            die;
        } 

        if (!$menu) {
            // Redirect to page 404 if menu is not found
            header('location: /404');
            die;
        }
        header('location: /admin/menus');
    }
}