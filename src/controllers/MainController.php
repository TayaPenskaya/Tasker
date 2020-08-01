<?php


namespace App\Controllers;

use App\Core\Controller;
class MainController extends Controller {

    public function start() {
        $this->view->render();
    }

}