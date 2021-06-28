<?php

namespace App\Core;

class View {
	private $template;
	private $view;
	private $data = [];

	public function __construct($view, $template = 'front') {
		$this->setTemplate($template);
		$this->setView($view);
		$this->assign('_title', 'CMS');
		$this->assign('_', new Helpers());
		$this->assign('_FB', new FormBuilder());
		$this->assign('_S', 'security');
	}

	public function setTemplate($template) {
		if (file_exists("Views/Templates/".$template.".tpl.php")) {
			$this->template = "Views/Templates/".$template.".tpl.php";
		} else {
			die("404: File $template.tpl.php not found");
		}
	}

	public function setView($view) {
		if (file_exists("Views/".$view.".view.php")) {
			$this->view = "Views/".$view.".view.php";
		} else {
			die("404: View $view.view.php not found");
		}
	}

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}

	public function __destruct() {
		extract($this->data);
		include $this->template;
	}
}