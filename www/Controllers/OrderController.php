<?php

namespace App\Controllers;

use App\Core\FormValidator;
use App\Core\Message;
use App\Core\View;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_Order;

class OrderController
{
    public function main()
    {
        $view = new View('orders.main', 'admin');
    }

    public function newOrder()
    {
        $Product = new Product();

        if (!empty($_POST)) {
            $products = json_decode($_POST['products']);
            if (!count($products)) { // verification if empty
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                return;
            }
            foreach ($products as $item) { // verification of ids
                $product = $Product->find(['id' => $item->id], [], false);
                if (empty($product)) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    return;
                };
            }
            $totalPrice = array_reduce($products, function ($accumulator, $item) use ($Product) {
                $product = $Product->find(['id' => $item->id], [], false);
                return $accumulator + $product->getPrice() * $item->quantity;
            });
            $productsQuantity = array_reduce($products, function ($accumulator, $item) use ($Product) {
                return $accumulator + $item->quantity;
            });
            $Order = new Order();
            $Order->setStatus(0); // 0 = prepare order
            $Order->setTotal_price($totalPrice);
            $Order->setProduct_count($productsQuantity);
            $Order->setUser_id($_SESSION['userStore']->id);
            $order = $Order->save();
            foreach ($products as $item) {
                $orderProduct = new Product_Order();
                $orderProduct->setOrder_id($order->id);
                $orderProduct->setProduct_id($item->id);
                $orderProduct->setProduct_quantity($item->quantity);
                $orderProduct->save();
            }
            header('Location: /order?order_id='.$order->id);
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function order() {
        $view = new View('order', 'front');
        $orderId = $_GET['order_id'];

        $Order = new Order();
        $ProductOrder = new Product_Order();
        $Product = new Product();
        $Address = new Address();

        $order = $Order->find(['id' => $orderId]);
        if (empty($order) || $order->getUser_id() !== $_SESSION['userStore']->id) {
            header('Location: /');
            return;
        }
        $productsOrder = $ProductOrder->findAll(['order_id' => $orderId], [], true);
        $products = array_map(function ($item) use ($Product) {
            return
                $Product->find(['id' => $item->getProduct_id()], [], true)
                + ['product_quantity' => $item->getProduct_quantity()];
        }, $productsOrder);


        $view->assign('products', $products);
        $view->assign('order', $order);
        $view->assign('formAddress', $Address->formAddress());

    }

    public function validateOrder() {
        if (!empty($_POST)){
            $Address = new Address();
            $Order = new Order();
            $addressForm = $Address->formAddress();
            $errors = FormValidator::check($addressForm, $_POST);
            if (empty($errors)){
                $Address->setUser_id($_SESSION['userStore']->id);
                $Address->setName($_POST['name']);
                $Address->setAddress($_POST['address']);
                $Address->setAddress2($_POST['address2'] ?? '');
                $Address->setDistrict($_POST['district']);
                $Address->setCity($_POST['city']);
                $Address->setPostal_code($_POST['postal_code']);
                $Address->setPhone($_POST['phone']);
                $address = $Address->save();
                $order = $Order->find(['user_id' => $_SESSION['userStore']->id], ['id' => 'DESC']);
                $order->setAddress_id($address->id);
                $order->setStatus(1); // 1 = invoice paid
                $order->save();
                http_response_code(201);
                echo json_encode(['order_id' => $order->getId()]);
            } else {
                http_response_code(400);
                echo json_encode($errors);
            }

        }
    }

    public function confirmOrder() {
        $view = new View('orderConfirmed', 'front');
        $Order = new Order();
        $Address = new Address();
        $order = $Order->find(['user_id' => $_SESSION['userStore']->id, 'status' => 1], ['id' => 'DESC']);
        $address = $Address->find(['id' => $order->getAddress_id()]);
        $view->assign('order', $order);
        $view->assign('address', $address);
    }
}
