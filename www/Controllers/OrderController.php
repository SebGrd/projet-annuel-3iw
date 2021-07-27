<?php

namespace App\Controllers;

use App\Core\View;
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
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
