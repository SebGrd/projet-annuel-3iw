<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\FormValidator;
use App\Models\Product;
use App\Core\Helpers;
use App\Core\Message;

class ProductController
{
    public function main()
    {
        $view = new View('products.main', 'admin');
    }

    public function newProduct()
    {
        $view = new View('products.new', 'admin');
        $product = new Product();

        $form = $product->formProduct();

        if (!empty($_POST)) {
            $errors = FormValidator::check($form, $_POST);

            if (empty($errors)) {
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $quantity = htmlspecialchars(strip_tags($_POST['quantity']));
                $price = Helpers::tofloat(htmlspecialchars(strip_tags($_POST['price'])));

                $product->find(['name' => $name]);
                if ($product->getId()) {
                    $view->assign('errors', ["Le produit $name existe déjà"]);
                } else {

                    $image = Helpers::upload('products');

                    if (isset($image['error'])) {
                        $view->assign('errors', [$image['error']]);
                    } else {
                        $product->setName($name);
                        $product->setDescription($description);
                        $product->setQuantity($quantity);
                        $product->setPrice($price);
                        $product->setImage($image !== false ? $image : null);
                        $product->save();

                        Message::add('NEW_PRODUCT_SUCCESS');
                    }
                }
            } else {
                $view->assign('errors', $errors);
                Message::add('NEW_PRODUCT_ERROR');
            }
        }
        $view->assign('form', $form);
    }

    public function editProduct()
    {
        $view = new View('products.edit', 'admin');
        $product = new Product();
        $id = htmlspecialchars(strip_tags($_GET['id']));

        // $form = $product->formProduct();
        // $view->assign('form', $form);

        if (empty($_GET['id'])) {
            // Redirect to page 404 if query is malformed
            header('Location:/404');
            die;
        } else if (isset($_GET['id']) && isset($_GET['action'])) {
            // Delete if action delete is send with id

            if (ctype_digit($id)) {
                $product = $product->delete(['id' => $id]);
                header('Location:/admin/products');
            } else {
                // Redirect to page 404 if query is malformed
                header('Location:/404');
                die;
            }
        } else {
            // Check if id is an integer
            if (ctype_digit($id)) {
                $product = $product->find(['id' => $id]);

                $form = $product->formProduct();
                $view->assign('form', $form);
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

            if (!empty($_POST)) {
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $quantity = htmlspecialchars(strip_tags($_POST['quantity']));
                $price = Helpers::tofloat(htmlspecialchars(strip_tags($_POST['price'])));
                $image = Helpers::upload('products');

                if (isset($image['error'])) {
                    $view->assign('errors', [$image['error']]);
                } else {
                    $product->setName($name);
                    $product->setDescription($description);
                    $product->setQuantity($quantity);
                    $product->setPrice($price);
                    $product->setImage($image !== false ? $image : null);
                }
            }

            $view->assign('product', $product);

            if (!empty($_POST)) {
                $errors = FormValidator::check($form, $_POST);

                if (empty($errors)) {
                    $product->save();
                    $view->assign('success', "Le produit $name a bien été mis à jour");
                    Message::add('EDIT_PRODUCT_SUCCESS');
                } else {
                    $view->assign('errors', $errors);
                    Message::add('EDIT_PRODUCT_ERROR');
                }
            }
        }
    }
}
