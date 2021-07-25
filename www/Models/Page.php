<?php

namespace App\Models;

use App\Core\Database;

class Page extends Database {
    private $id = null;
    protected $title = '';
    protected $image = null;
    protected $html = '';
    protected $createdAt = '';
	protected $updatedAt = '';
	protected $active = 1;

	public function __construct(){
		parent::__construct();
		if ($this->id == null) {
			$this->setCreatedAt();
		}
	$this->setUpdatedAt();
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

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt() {
		$this->createdAt = date('Y-m-d H:i:s');
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * @param mixed $updatedAt
	 */
	public function setUpdatedAt() {
		$this->updatedAt = date('Y-m-d H:i:s');
	}

	/**
	 * @return int
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * @param int $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}

    public function formPage() {
        return [
            'config'=>[
                'method'=>'POST',
                'action'=>'',
                'id'=>'form_create_page',
                'class'=>'form',
                'submit'=>'Enregistrer'
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
                    'required'=>true,
					'value'=>$this->title
                ],
                'html'=>[
                    'type'=>'hidden',
                    'minLength'=>0,
                    'id'=>'html',
                    'class'=>'form_input d-none',
                    'error'=>'Erreur',
                    'required'=>true,
					'value'=>$this->html
                ],
                'image'=>[
                    'type'=>'file',
                    'label'=>'Image à la une',
                    'id'=>'upfile',
                    'name'=>'upfile',
                    'class'=>'form_input',
                    'error'=>'Image invalide',
                    'required'=>false
                ],
            ]
        ];
    }
    public function formPageEdit() {
        return [
            'config'=>[
                'method'=>'POST',
                'action'=>'',
                'id'=>'form_create_page',
                'class'=>'form',
                'submit'=>"Mettre à jour"
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
                    'required'=>true,
					'value'=>$this->title
                ],
                'html'=>[
                    'type'=>'hidden',
                    'minLength'=>0,
                    'id'=>'html',
                    'class'=>'form_input d-none',
                    'error'=>'Erreur',
                    'required'=>true,
					'value'=>$this->html
                ],
                'image'=>[
                    'type'=>'file',
                    'label'=>'Image à la une',
                    'id'=>'upfile',
                    'name'=>'upfile',
                    'class'=>'form_input',
                    'error'=>'Image invalide',
                    'required'=>false
                ],
                'active'=>[
                    'type'=>'checkbox',
                    'label'=>'Actif',
                    'id'=>'active',
                    'class'=>'form_input',
                    'required'=>false,
                    'value'=>$this->active,
                ],
            ]
        ];
    }
    public function formPageEdit() {
        return [
            'config'=>[
                'method'=>'POST',
                'action'=>'',
                'id'=>'form_create_page',
                'class'=>'form',
                'submit'=>"Mettre à jour"
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
                    'required'=>true,
					'value'=>$this->title
                ],
                'html'=>[
                    'type'=>'hidden',
                    'minLength'=>0,
                    'id'=>'html',
                    'class'=>'form_input d-none',
                    'error'=>'Erreur',
                    'required'=>true,
					'value'=>$this->html
                ],
                'image'=>[
                    'type'=>'file',
                    'label'=>'Image à la une',
                    'id'=>'upfile',
                    'name'=>'upfile',
                    'class'=>'form_input',
                    'error'=>'Image invalide',
                    'required'=>false
                ],
                'active'=>[
                    'type'=>'checkbox',
                    'label'=>'Actif',
                    'id'=>'active',
                    'class'=>'form_input',
                    'required'=>false,
                    'value'=>$this->active,
                ],
            ]
        ];
    }
}