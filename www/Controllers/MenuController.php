<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\FormValidator;
use App\Models\Menu;
use App\Core\Helpers;
use App\Core\ConstantMaker;

class MenuController
{
    public function default() {
		$constantMaker = new ConstantMaker();
        $view = new View('menus', 'admin');
		$menu = new Menu();

        $form = $menu->formMenu();

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $title = htmlspecialchars(strip_tags($_POST['title']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
    
                $menu->find(['title' => $title]);
    
                if ($menu->getId()) {
                    $view->assign('errors', ['Le menu ' . $title . ' existe déjà']);
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
                        $view->assign('success', 'Le menu ' . $title . ' a été créé');
                    }
                }
            } else {
                $view->assign('errors', $errors);
            }
		}


        $allMenus = $menu->findAll([], [], true);
        $view->assign('menus', $allMenus);

		$view->assign('form', $form);
    }

    public function editMenu() {
		$constantMaker = new ConstantMaker();
        $view = new View('editMenu', 'admin');
		$menu = new Menu();

        if (empty($_GET['id'])) {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        $id = htmlspecialchars( strip_tags( $_GET['id'] ) );

        // Check if id is an integer
        if (ctype_digit($id)) {
            $menu = $menu->find(['id' => $id]);
        } else {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        if (!$menu) {
            // Redirect to page 404 if menu is not found
            header('Location:/404');
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

        $form = $menu->formMenu();
        // Assign menu object to the view
        $view->assign('menu', $menu);
        // Assign the form to the view
        $view->assign('form', $form);

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $menu->save();
                $view->assign('success', 'Le menu ' . $title . ' a bien été mis à jour');
            } else {
                $view->assign('errors', $errors);
            }
		}
    }

    public function deleteMenu() {
		$constantMaker = new ConstantMaker();
		$menu = new Menu();

        if ( empty( $_GET['id'] ) ) {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        $id = htmlspecialchars( strip_tags( $_GET['id'] ) );

        // Check if id is an integer
        if (ctype_digit($id)) {
            $menu = $menu->delete(['id' => $id]);
        } else {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        if (!$menu) {
            // Redirect to page 404 if menu is not found
            header('Location:/404');
            die;
        }
        header('Location:/admin/menus');
    }
}