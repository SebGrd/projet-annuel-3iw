<?php


namespace App\Controllers;
use App\Core\View;
use App\Core\Helpers;
use App\Core\FormValidator;
use App\Models\Menu;
use App\Core\ConstantMaker;
use App\Models\Page;


class Admin
{
    public function default() {
        $view = new View('dashboard', 'admin');
        // $view->assign('username', 'toto');
    }

    public function menus() {
		$constantMaker = new ConstantMaker();
        $view = new View('menus', 'admin');
		$menu = new Menu();

        $form = $menu->formMenu();
        $allMenus = $menu->findAll([], [], true);

        $view->assign('menus', $allMenus);

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

    public function pages() {
        $constantMaker = new ConstantMaker();
        $view = new View('adminPages', 'admin');
        $page = new Page();
        $pageForm = $page->formCreatePage();
        $view->assign('pageForm', $pageForm);
        if ($_POST){
            $errors = FormValidator::check($pageForm, $_POST);
            if (empty($errors)) {
                $view->assign('debug', $page);
                $page->setTitle($_POST['title']);
                $page->setHtml($_POST['html']);
                $page->setImage($_POST['title']);
                $page->save();
            } else {
                $view->assign('errors', $errors);
            }
        }
    }
}