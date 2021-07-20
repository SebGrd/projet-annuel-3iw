<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\Helpers;
use App\Models\Menu;
use App\Models\User;
use App\Core\FormValidator;
use App\Core\ConstantMaker;

class AdminController
{
    public function main() {
        $view = new View('admin.main', 'admin');
    }
}