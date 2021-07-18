<?php

namespace App\Controllers;
use App\Core\View;
use App\Core\FormValidator;
use App\Core\ConstantMaker;
use App\Models\Page;

class AdminController
{
    public function default() {
        $view = new View('dashboard', 'admin');
    }
}