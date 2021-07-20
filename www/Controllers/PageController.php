<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker;
use App\Models\Page;

class PageController
{
    public function __construct() {
		$constantMaker = new ConstantMaker();
    }

    public function main() {
        $view = new View('pages.main', 'admin');
        $page = new Page();
    }

    public function newPage() {
        $view = new View('pages.new', 'admin');
        $page = new Page();
        $pageForm = $page->formPage();
        $view->assign('pageForm', $pageForm);

        if (!empty($_POST)) {
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

    public function editPage() {
        $view = new View('pages.edit', 'admin');
		$page = new Page();
        $id = htmlspecialchars( strip_tags( $_GET['id'] ) );

        if ( empty( $_GET['id'] ) ) {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        } else if (isset($_GET['id']) && isset($_GET['action'])) {
            // Delete if action delete is send with id

            if (ctype_digit($id)) {
                $page = $page->delete(['id' => $id]);
                header('Location:/admin/pages');
            } else {
                // Redirect to page 404 if query is malformed
                header('Location:/404');
                die;
            }
        } else {
            // Check if id is an integer
            if (ctype_digit($id)) {
                $page = $page->find(['id' => $id]);
            } else {
                // Redirect to page 404 if query is malformed
                header('Location:/404');
                die;
            }

            if (!$page) {
                // Redirect to page 404 if page is not found
                header('Location:/404');
                die;
            }

            $form = $page->formPage();
            $view->assign('form', $form);

            if (!empty($_POST)) {
                $title = htmlspecialchars(strip_tags($_POST['title']));
                $image = Helpers::upload('pages');
                $html = htmlspecialchars(strip_tags($_POST['html']));
    
                if (isset($image['error'])) {
                    $view->assign('errors', [$image['error']]);
                } else {
                    $page->setTitle($title);
                    $page->setImage($image !== false ? $image : null);
                    $page->setHtml($html);
                }
            }

            $view->assign('page', $page);

            if (!empty($_POST)) {
                $errors = FormValidator::check($form, $_POST);
                
                if (empty($errors)) {
                    $page->save();
                    $view->assign('success', "Le produit $title a bien été mis à jour");
                } else {
                    $view->assign('errors', $errors);
                }
            }
        }
    }
}