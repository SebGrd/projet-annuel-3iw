<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\FormValidator;
use App\Models\Product;
use App\Core\ConstantMaker;

class ProductController
{
    public function default() {
		$constantMaker = new ConstantMaker();
        $view = new View('adminProducts', 'admin');
		$menu = new Product();

        $form = $menu->formProduct();

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
    
                $menu->find(['name' => $name]);
    
                if ($menu->getId()) {
                    $view->assign('errors', ['Le produit ' . $name . ' existe déjà']);
                } else {
                    // Create menu
                    $menu->setName($name);
                    $menu->setDescription($description);
                    $menu->save();
                    $view->assign('success', 'Le produit ' . $name . ' a été créé');
                }
            } else {
                $view->assign('errors', $errors);
            }
		}

        $allMenus = $menu->findAll([], [], true);
        $view->assign('menus', $allMenus);

		$view->assign('form', $form);
    }

    public function editProduct() {
		$constantMaker = new ConstantMaker();
        $view = new View('editProduct', 'admin');
		$product = new Product();

        if ( empty( $_GET['id'] ) ) {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        $id = htmlspecialchars( strip_tags( $_GET['id'] ) );

        // Check if id is an integer
        if (ctype_digit($id)) {
            $product = $product->find(['id' => $id]);
        } else {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        if (!$product) {
            // Redirect to page 404 if menu is not found
            header('Location:/404');
            die;
        }

        if (!empty($_POST)) {
        
            $title = htmlspecialchars(strip_tags($_POST['title']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            // Update menu
            $product->setTitle($title);
            $product->setDescription($description);
        }

        $form = $menu->formMenu();
        // Assign menu object to the view
        $view->assign('product', $menu);
        // Assign the form to the view
        $view->assign('form', $form);

        if (!empty($_POST)) {
			$errors = FormValidator::check($form, $_POST);
            
			if (empty($errors)) {
                $menu->save();
                $view->assign('success', 'Le produit ' . $title . ' a bien été mis à jour');
            } else {
                $view->assign('errors', $errors);
            }
		}
    }

    public function deleteProduct() {
		$constantMaker = new ConstantMaker();
		$product = new Product();

        if ( empty( $_GET['id'] ) ) {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        $id = htmlspecialchars( strip_tags( $_GET['id'] ) );

        // Check if id is an integer
        if (ctype_digit($id)) {
            $product = $product->delete(['id' => $id]);
        } else {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        }

        if (!$product) {
            // Redirect to page 404 if product is not found
            header('Location:/404');
            die;
        }
        header('Location:/admin/products');
    }
}