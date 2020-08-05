<?php


namespace App\core;


abstract class Controller {
    protected View $view;

    public function __construct($route) {
        $this->view = new View($route);
    }

}