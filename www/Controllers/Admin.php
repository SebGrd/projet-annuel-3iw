<?php


namespace App\Controllers;
use App\Core\View;
use App\Core\Helpers;
use App\Core\FormValidator;
use App\Models\Menu;
use App\Core\ConstantMaker;


class Admin
{
    public function default() {
        $view = new View('dashboard', 'admin');
        // $view->assign('username', 'toto');
    }

    public function menus() {
		$constantMaker = new ConstantMaker();
        $view = new View('editMenus', 'admin');
		$menu = new Menu();

        $form = $menu->formMenu();

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $title = htmlspecialchars(strip_tags(strtolower($_POST['title'])));
                $description = htmlspecialchars(strip_tags(strtolower($_POST['description'])));
    
                $menu->find(['title' => $title]);
    
                if ($menu->getId()) {
                    $view->assign('errors', ['Le menu ' . $title . ' existe déjà']);
                } else {
                    // Create menu
                    $menu->setTitle($title);
                    $menu->setDescription($description);
                    $menu->save();
                    $view->assign('success', 'Le menu ' . $title . ' a été créé');
                }
            } else {
                $view->assign('errors', $errors);
            }
		}

		$view->assign('form', $form);
    }
}