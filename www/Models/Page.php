<?php

namespace App\Models;

use App\Core\Database;

class Page extends Database {
    public $id = null;
    public $title;
    public $image;
    public $html;

    public function __construct(){
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    public function formCreatePage() {
        return [
            'config'=>[
                'method'=>'POST',
                'action'=>'',
                'id'=>'form_create_page',
                'class'=>'form',
                'submit'=>"Ajouter"
            ],
            'inputs'=>[
                'title'=>[
                    'type'=>'text',
                    'label'=>'Titre de la page',
                    'minLength'=>2,
                    'maxLength'=>55,
                    'id'=>'title',
                    'class'=>'form_input',
                    'error'=>'Le titre de la page doit faire entre 2 et 55 caractères',
                    'required'=>true
                ],
                'html'=>[
                    'type'=>'hidden',
                    'minLength'=>0,
                    'id'=>'html',
                    'class'=>'form_input d-none',
                    'error'=>'Erreur',
                    'required'=>false
                ],
                'image'=>[
                    'type'=>'text',
                    'label'=>'Image à la une',
                    'id'=>'image',
                    'class'=>'form_input',
                    'error'=>'Erreur',
                    'required'=>false
                ],
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $html
     */
    public function setHtml($html): void
    {
        $this->html = $html;
    }
}