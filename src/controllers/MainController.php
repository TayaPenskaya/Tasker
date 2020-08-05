<?php


namespace App\controllers;

use App\core\Controller;
class MainController extends Controller {

    public function start() {
        $this->view->redirect('/tasks/show');
    }

}