<?php


namespace App\Controllers;
use App\Core\View;
use App\Core\Helpers;


class Admin
{
    public function default() {
        $view = new View('dashboard', 'admin');
        $view->assign('username', 'toto');

    }
}