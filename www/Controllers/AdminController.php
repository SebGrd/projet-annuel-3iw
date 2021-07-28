<?php

namespace App\Controllers;
use App\Core\View;
use App\Models\Menu;
use App\Models\User;
use App\Models\Page;
use App\Models\Product;
use App\Models\Order;

class AdminController
{
	public function main() {
		$view = new View('admin.main', 'admin');
		$page = new Page();
		$menu = new Menu();
		$product = new Product();
		$user = new User();
		$order = new Order();
		
		$view->assign('pages', count((array) $page->findAll([], [], true)));
		$view->assign('menus', count((array) $menu->findAll([], [], true)));
		$view->assign('products', count((array) $product->findAll([], [], true)));
		$view->assign('users', count((array) $user->findAll([], [], true)));
		$view->assign('orders', count((array) $order->findAll([], [], true)));
	}
	
	/**
	* Stats method
	*
	* Show the stats view
	**/
	public function stats() {
		$view = new View('admin.stats', 'admin');
		$page = new Page();
		$menu = new Menu();
		$product = new Product();
		$user = new User();
		$order = new Order();

		$data = [
			'Pages' => $page,
			'Menus' => $menu,
			'Produits' => $product,
			'Utilisateurs' => $user,
			'Commandes' => $order
		];
		$arr = [];

		foreach ($data as $key => $obj) {
			$arr[] = ['obj' => $key, 'count' => count((array) $obj->findAll([], [], true))];
		}

		$view->assign('countData', json_encode($arr));
	}
}