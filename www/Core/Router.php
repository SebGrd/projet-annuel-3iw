<?php
namespace App\Core;

class Router {
	private $routes = [];
	private $uri;
	private $routesPath = 'routes.yml';
	private $controller;
	private $action;

	public function __construct($uri) {
		$this->setUri($uri);
		if(file_exists($this->routesPath)) {
			//[/] => Array ( [controller] => Global [action] => default )
			$this->routes = yaml_parse_file($this->routesPath);

			if (!empty($this->routes[$this->uri]) && $this->routes[$this->uri]['controller'] && $this->routes[$this->uri]['action']) {
				$this->setController($this->routes[$this->uri]['controller']);
				$this->setAction($this->routes[$this->uri]['action']);
			} else {
				die("404: Route $uri not found");
				// TODO render error view
			}
		} else {
			die("Routes file {$this->$routesPath} not found");
			// TODO render error view
		}
	}

	public function setUri($uri) {
		$this->uri = trim(mb_strtolower($uri));
	}

	public function setController($controller) {
		$this->controller = $controller;
	}

	public function setAction($action) {
		$this->action = $action;
	}

	public function getController() {
		return $this->controller;
	}

	public function getAction() {
		return $this->action;
	}
}