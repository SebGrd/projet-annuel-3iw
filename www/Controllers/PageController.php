<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker;
use App\Models\Page;

class PageController
{
    public function pages() {
        $constantMaker = new ConstantMaker();
        $view = new View('adminPages', 'admin');
        $page = new Page();
    }

    public function newPage() {
        $constantMaker = new ConstantMaker();
        $view = new View('adminPagesNew', 'admin');
        $page = new Page();
        $pageForm = $page->formCreatePage();
        $view->assign('pageForm', $pageForm);
        if (isset($_POST)){
            $errors = FormValidator::check($pageForm, $_POST);
            if (empty($errors)) {
                $page->setTitle($_POST['title']);
                $page->setHtml($_POST['html']);
                $page->setImage($_POST['title']);
                $page->save();
                header('Location: /admin/pages');

            } else {
                $view->assign('errors', $errors);
            }
        }
    }
}