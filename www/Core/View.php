<?php

namespace App\Core;

class View {
	private $template;
	private $view;
	private $data = [];
	const GLOBALS = [
		'_title' => 'CMS',
		'_' => Helpers::class,
		'_R' => Router::class,
		'_S' => Security::class,
		'_V' => View::class,
		'_FB' => FormBuilder::class,
		'_TB' => TableBuilder::class,
		'_SS' => Session::class,
		'_M' => Message::class
	];

	public function __construct($view, $template = 'front') {
		$view = str_replace('.', '/', $view);
		$this->setTemplate($template);
		$this->setView($view);

		foreach (View::GLOBALS as $key => $value) {
			$this->assign($key, $value);
		}

		$this->assign('user', $_SESSION['userStore'] ?? []);
	}

	public function setTemplate($template) {
		if (file_exists("Views/Templates/$template.tpl.php")) {
			$this->template = "Views/Templates/$template.tpl.php";
		} else {
			die("404: File $template.tpl.php not found");
		}
	}

	public function setView($view) {
		if (file_exists("Views/$view.view.php")) {
			$this->view = "Views/$view.view.php";
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