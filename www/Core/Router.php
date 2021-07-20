<?php
namespace App\Core;

use App\Controllers\MainController;

class Router {
	/**
     * The path to the 'home' route
     *
     * This is used to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

	/**
     * Path to the 'login' route
     *
     * This is used to redirect users logging out or accessing unauthorized routes.
     *
     * @var string
     */
    public const LOGIN = '/login';

	/**
     * All the routes from `routes.yml` in the root folder.
     *
     * @var array
     */
	private $routes = [];

	/**
     * Path to the 'home' route
     *
     * This is used to redirect users after login.
     *
     * @var string
     */
	private $uri;

	/**
     * Path to the routes configuration
     *
     * Contains `controller`, `route` and `access` for each route.
     *
     * @var string
     */
	private $routesPath = 'routes.yml';

	/**
     * Controller of the current route
     *
     * @var string
     */
	private $controller;

	/**
     *	Action of the current route
     *
     * @var string
     */
	private $action;

	/**
     *  Access of the current route
     *
     * @var string
     */
	private $access;

	public function __construct($uri) {
		$this->setUri($uri);
		if (file_exists($this->routesPath)) {
			$this->routes = yaml_parse_file($this->routesPath);

			if (!empty($this->routes[$this->uri])
					&& $this->routes[$this->uri]['controller']
					&& $this->routes[$this->uri]['action']
					&& $this->routes[$this->uri]['access']) {
				$this->setController($this->routes[$this->uri]['controller']);
				$this->setAction($this->routes[$this->uri]['action']);
				$this->setAccess($this->routes[$this->uri]['access']);

				$this->checkCurrentRoute();

			} else {
				(new MainController)->notFound("Route <b><code>$uri</code></b> introuvable");
			}
		} else {
			(new MainController)->notFound("Fichier <b><code>{$this->routesPath}</code></b> introuvable dans la racine");
		}
	}

	public function checkCurrentRoute() {
		$m = "App\\Controllers\\MainController";
		$c = $this->getController();
		$a = $this->getAction();
		$ac = $this->getAccess();

		if (file_exists("Controllers/$c.php")) {
			include "Controllers/$c.php";
			$c = "App\\Controllers\\$c";

			if (class_exists($c)) {
				$cObjet = new $c();

				if (method_exists($cObjet, $a)) {
					// Render view if middleware is respected
					$roles = explode(';', $ac);
					$authorized = Security::isAuthorized($roles);

					if (!$authorized) { header('location: /login'); }

					$cObjet->$a();
				} else {
					(new MainController)->notFound("Action <b>$a</b> introuvable");
				}
			} else {
				(new MainController)->notFound("Contrôleur <b>$c</b> introuvable");
			}
		} else {
			(new MainController)->notFound("Fichier <b>Controllers/$c.php</b> introuvable");
		}
	}

	public function setUri($uri) {
		$this->uri = trim(mb_strtolower($uri));
	}

	public function getController() {
		return $this->controller;
	}

	public function setController($controller) {
		$this->controller = $controller;
	}
	
	public function getAction() {
		return $this->action;
	}
	
	public function setAction($action) {
		$this->action = $action;
	}
	
	public function getAccess() {
		return $this->access;
	}

	public function setAccess($access) {
		$this->access = $access;
	}

	// Returns root URL
    public static function getRootURL() {
        return "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}";
    }

	// Returns current route
    public static function getCurrentRoute() {
        return $_SERVER['REQUEST_URI'];
    }

    // Returns current URL
    public static function getCurrentURL() {
        return self::getRootURL() . self::getCurrentRoute();
    }
}