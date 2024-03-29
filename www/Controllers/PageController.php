<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\FormValidator;
use App\Models\Menu;
use App\Models\Menu_Product;
use App\Models\Page;
use App\Core\Helpers;
use App\Core\Message;
use App\Models\Product;

class PageController
{
    public function main()
    {
        $view = new View('pages.main', 'admin');
    }

    public function newPage()
    {
        $view = new View('pages.new', 'admin');
        $page = new Page();
        $pageForm = $page->formPage();

        if (!empty($_POST)) {
            $errors = FormValidator::check($pageForm, $_POST);
            if (empty($errors)) {
                $title = htmlspecialchars(strip_tags($_POST['title']));
                $html = htmlentities($_POST['html']);

                $page->find(['title' => $title]);

                if ($page->getId()) {
                    $view->assign('errors', ["La page $title existe déjà"]);
                    Message::add('NEW_PAGE_ERROR');
                } else {
                    $image = Helpers::upload('products');

                    if (isset($image['error'])) {
                        $view->assign('errors', [$image['error']]);
                    } else {
                        $page->setTitle($title);
                        $page->setHtml($html);
                        $page->setImage($image !== false ? $image : null);
                        $page->save();

                        Message::add('NEW_PAGE_SUCCESS');
                    }
                }
            } else {
                $view->assign('errors', $errors);
                Message::add('NEW_PAGE_ERROR');
            }
        }

        $view->assign('pageForm', $pageForm);
    }

    public function editPage()
    {
        $view = new View('pages.edit', 'admin');
        $page = new Page();
        $id = htmlspecialchars(strip_tags($_GET['id']));

        if (empty($_GET['id'])) {
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

            if (!empty($_POST)) {
                $title = htmlspecialchars(strip_tags($_POST['title']));
                $html = htmlentities($_POST['html']);
                $active = isset($_POST['active']) && htmlspecialchars(strip_tags($_POST['active'])) === 'on' ? 1 : 0;
                $image = Helpers::upload('pages');
                if ($image !== false) {
                    $page->setImage($image);
                }

                if (isset($image['error'])) {
                    $view->assign('errors', [$image['error']]);
                } else {
                    $page->setTitle($title);
                    $page->setHtml($html);
                    $page->setActive($active);
                }
            }

            $form = $page->formPageEdit();
            $view->assign('page', $page);
            $view->assign('form', $form);

            if (!empty($_POST)) {
                $errors = FormValidator::check($form, $_POST);

                if (empty($errors)) {
                    $page->save();
                    Message::add('EDIT_PAGE_SUCCESS');
                } else {
                    $view->assign('errors', $errors);
                    Message::add('EDIT_PAGE_ERROR');
                }
            }
        }
    }

    public function show()
    {
        $view = new View('pages.show', 'front');
        $page = new Page();
        $id = htmlspecialchars(strip_tags($_GET['id']));

        if (empty($_GET['id'])) {
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

            $view->assign('page', $page);
        }
    }

    public function products()
    {
        $view = new View('products', 'front');
        $Product = new Product();
        $Menu = new Menu();
        $MenuProduct = new Menu_Product();

        $menuProducts = $MenuProduct->findAll([], [], true);
        $products = $Product->findAll([], [], true);
        $menus = $Menu->findAll([], [], true);

        $data = [];

        foreach ($menuProducts as $menuProduct) {
            foreach ($products as $product) {
                if ($product->getId() === $menuProduct->getProduct_id()){
                    if(!isset($data[$menuProduct->getMenu_id()])){
                        $data[$menuProduct->getMenu_id()] = [];
                        array_push($data[$menuProduct->getMenu_id()], $product);
                    } elseif (isset($data[$menuProduct->getMenu_id()])) {
                        array_push($data[$menuProduct->getMenu_id()], $product);
                    }
                }
            }
        }



        $view->assign('products', $products);
        $view->assign('menus', $menus);
        $view->assign('menuProducts', $data);
    }
}
