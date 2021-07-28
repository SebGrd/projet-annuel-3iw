<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\Helpers;
use App\Models\Menu;
use App\Models\User;
use App\Models\Page;
use App\Models\Product;
use App\Models\Order;
use App\Core\FormValidator;
use App\Core\ConstantMaker;

class AdminController
{
	public function main() {
		$view = new View('admin.main', 'admin');
		$page = new Page();
		$menu = new Menu();
		$product = new Product();
		$user = new User();
		$user = new Order();
		
		$view->assign('pages', (array) $page->findAll([], [], true));
		$view->assign('menus', (array) $menu->findAll([], [], true));
		$view->assign('products', (array) $product->findAll([], [], true));
		$view->assign('users', (array) $user->findAll([], [], true));
		$view->assign('orders', (array) $order->findAll([], [], true));
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

		$data = ['Pages' => $page, 'Menus' => $menu, 'Produits' => $product, 'Utilisateurs' => $user];
		$arr = [];

		foreach ($data as $key => $obj) {
			$arr[] = ['obj' => $key, 'count' => count((array) $obj->findAll([], [], true))];
		}

		$view->assign('pages', (array) $page->findAll([], [], true));
		$view->assign('menus', (array) $menu->findAll([], [], true));
		$view->assign('products', (array) $product->findAll([], [], true));

		$view->assign('countData', json_encode($arr));
	}
}