<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\Database;
use App\Models\Order;
use App\Models\Product;
use App\Core\Helpers;
use App\Core\Message;

class OrderController
{
    public function main() {
        $view = new View('orders.main', 'admin');
		$order = new Order();
    }

    public function getAllOrders() {
        $view = new View('orders.main', 'admin');
		$order = new Order();
        $db = new Database();

        $stmt = $db->pdo->prepare('SELECT * FROM order ORDER BY createdAt DESC');
        $stmt->execute();
        // Fetch the products from the database and return the result as an Array
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $products;
    }

    public function newOrder() {
		$order = new Order();

        if (!empty($_POST)) {

            $title = htmlspecialchars(strip_tags($_POST['products']));

            $order->find(['title' => $title]);

            if ($order->getId()) {
            } else {
                $image = Helpers::upload('orders');

                if (isset($image['error'])) {
                } else {
                    // Create and save the order
                    $order->setUser_id($title);
                    $order->save();

                    Message::add('NEW_MENU_SUCCESS');
                }
            }
		}
    }

    // public function editMenu() {
    //     $view = new View('menus.edit', 'admin');
	// 	$menu = new Order();

    //     if (empty($_GET['id'])) {
    //         // Redirect to page 404 if query is malformed
    //         header('location: /404');
    //         die;
    //     }

    //     $id = htmlspecialchars(strip_tags($_GET['id']));

    //     if (empty($_GET['id'])) {
    //         // Redirect to page 404 if query is malformed
    //         header('location: /404');
    //         die;
    //     } else if (isset($_GET['id']) && isset($_GET['action'])) {
    //         // Delete if action delete is send with id
    //         if (ctype_digit($id)) {
    //             $menu = $menu->delete(['id' => $id]);
    //             header('location: /admin/menus');
    //         } else {
    //             // Redirect to page 404 if query is malformed
    //             header('location: /404');
    //             die;
    //         }
    //     } else {
    //         // Edit
    //         // Check if id is an integer
    //         if (ctype_digit($id)) {
    //             $menu = $menu->find(['id' => $id]);
    //         } else {
    //             // Redirect to page 404 if query is malformed
    //             header('location: /404');
    //             die;
    //         }
    
    //         if (!$menu) {
    //             // Redirect to page 404 if menu is not found
    //             header('location: /404');
    //             die;
    //         }
    
    //         if (!empty($_POST)) {
    //             $title = htmlspecialchars(strip_tags($_POST['title']));
    //             $description = htmlspecialchars(strip_tags($_POST['description']));
    
    //             $image = Helpers::upload('menus');
    
    //             if (isset($image['error'])) {
    //                 $view->assign('errors', [$image['error']]);
    //             } else {
    //                 $menu->setTitle($title);
    //                 $menu->setDescription($description);
    //                 $menu->setImage($image !== false ? $image : null);
    //             }
    //         }
    //     }

    //     $form = $menu->formMenu();
    //     // Assign menu object to the view
    //     $view->assign('menu', $menu);
    //     // Assign the form to the view
    //     $view->assign('form', $form);

    //     if (!empty($_POST)) {
	// 		$errors = FormValidator::check($form, $_POST);
            
	// 		if (empty($errors)) {
    //             $menu->save();
    //             $view->assign('success', "Le menu $title a bien été mis à jour");
    //         } else {
    //             $view->assign('errors', $errors);
    //         }
	// 	}
    // }
}