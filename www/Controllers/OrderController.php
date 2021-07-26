<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\Order;
use App\Core\Message;

class OrderController
{
    public function main() {
        $view = new View('orders.main', 'admin');
		$order = new Order();
    }

    // public function getAllOrders() {
    //     $view = new View('orders.main', 'admin');
	// 	$order = new Order();
    //     $db = new Database();

    //     $stmt = $db->pdo->prepare('SELECT * FROM order ORDER BY createdAt DESC');
    //     $stmt->execute();
    //     // Fetch the products from the database and return the result as an Array
    //     $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    //     return $products;
    // }

    public function newOrder() {
		$order = new Order();

        if (!empty($_POST)) {

            $products = (array) $_POST['products'];
            $user_id = $_SESSION['userStore']->getId();
            $product_count = 0;
            $total_price = 0;

            foreach ($products as $product) {
                $total_price += $product->getPrice();
                $product_count ++;
            }
            $user_id = null;
            $createdAt = '';
            $updatedAt = '';

            $order->find(['title' => $title]);

            if ($order->getId()) {
            } else {
                $order->setUser_id($title);
                $order->save();

                Message::add('NEW_MENU_SUCCESS');
            }
		}
    }
}