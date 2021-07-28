<?php

namespace App\Models;

use App\Core\Database;

class Menu_Product extends Database {
	private $id = null;
	protected $product_id = null;
	protected $menu_id = null;

	public function __construct(){
		parent::__construct();
	}

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id) {
        $this->id = $id;
        // double action de peupler l'objet avec ce qu'il y a en bdd
        // https://www.php.net/manual/fr/pdostatement.fetch.php
    }

    /**
     * @return null
     */
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * @param null $product_id
     */
    public function setProduct_id($product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return null
     */
    public function getMenu_id()
    {
        return $this->menu_id;
    }

    /**
     * @param null $menu_id
     */
    public function setMenu_id($menu_id): void
    {
        $this->menu_id = $menu_id;
    }

    public function categoryForm($productId) {
        $Menu = new Menu();
        $menus = $Menu->findAll([], [], true);
        $menuList = [];
        foreach ($menus as $menu) {
            $menuList[$menu->getId()] = $menu->getTitle();
        }
        return [
            'config'=>[
                'method'=>'POST',
                'action'=>'/admin/product-menu/update',
                'id'=>'form_product',
                'class'=>'form',
                'submit'=>"Enregistrer",
                'enctype'=>'multipart/form-data'
            ],
            'inputs'=>[
                'product_id'=>[
                    'type'=>'hidden',
                    'id'=>'product_id',
                    'class'=>'form_input',
                    'error'=>'ID not given',
                    'required'=>true,
                    'value'=>$productId
                ],
                'menu_id'=>[
                    'type'=>'select',
                    'label'=>'Role',
                    'id'=>'role',
                    'class'=>'form_input',
                    'options'=>$menuList,
                    'required'=>true,
                    'value'=>0
                ]
            ]
        ];
    }

}
