<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Menu;
use App\Models\User;
use App\Models\Page;
use App\Models\Product;

class AdminController
{

  public function main()
  {
    $view = new View('admin.main', 'admin');
    $page = new Page();
    $menu = new Menu();
    $product = new Product();
    $user = new User();

    $view->assign('pages', $page->findAll([], [], true));
    $view->assign('menus', $menu->findAll([], [], true));
    $view->assign('user', $user->find(['id' => $_SESSION['userStore']->id]));
    $view->assign('products', $product->findAll([], [], true));
  }
}
