<?php

namespace App\Controllers;

use App\Core\FormValidator;
use App\Core\Helpers;
use App\Core\Message;
use App\Core\View;
use App\Models\Menu;

class MenuController
{
    public function main()
    {
        $view = new View('menus.main', 'admin');
    }

    public function newMenu()
    {
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
                    Message::add('NEW_MENU_ERROR');
                } else {
                    $image = Helpers::upload('menus');
                    if ($image !== false) {
                        $menu->setImage($image);
                    }

                    if (isset($image['error'])) {
                        $view->assign('errors', [$image['error']]);
                    } else {
                        // Create and save the menu
                        $menu->setTitle($title);
                        $menu->setDescription($description);
                        $menu->save();
                        Message::add('NEW_MENU_SUCCESS');
                    }
                }
            } else {
                $view->assign('errors', $errors);
                Message::add('NEW_MENU_ERROR');
            }
        }

        $view->assign('form', $form);
    }

    public function editMenu()
    {
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
                if ($image !== false) {
                    $menu->setImage($image);
                }

                if (isset($image['error'])) {
                    $view->assign('errors', [$image['error']]);
                    Message::add('EDIT_MENU_ERROR');
                } else {
                    $menu->setTitle($title);
                    $menu->setDescription($description);
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
                Message::add('EDIT_MENU_SUCCESS');
            } else {
                $view->assign('errors', $errors);
                Message::add('EDIT_MENU_ERROR');
            }
        }
    }

    public function deleteMenu()
    {
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
