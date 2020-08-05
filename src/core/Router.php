<?php


namespace App\core;

use App\config\Constants;
use App\exceptions\RouterExceptions\NoSuchActionException;
use App\exceptions\RouterExceptions\NoSuchControllerException;
use App\exceptions\RouterExceptions\NoSuchRouteException;
use Exception;

class Router {
    private array $routes = [];
    private array $params = [];

    public function __construct() {
        $arr = Constants::routes;
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function add($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match() : bool {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run() {
        try {
            if ($this->match()) {
                $path = 'App\controllers\\'.ucfirst($this->params['controller']).'Controller';
                if (class_exists($path)){
                    $action = $this->params['action'];
                    if (method_exists($path, $action)) {
                        $controller = new $path($this->params);
                        $controller->$action();
                        return Constants::happyControllerMessage;
                    }
                    throw new NoSuchActionException($action);
                }
                throw new NoSuchControllerException($path);
            }
            throw new NoSuchRouteException();
        } catch (Exception $exception) {
            View::error($exception->getMessage());
        }
    }
}