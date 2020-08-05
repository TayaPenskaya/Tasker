<?php


namespace App\controllers;

use App\core\Controller;
use App\core\View;

class AdminController extends Controller {

    public function hello() {
        $this->view->render();
    }

    public function logout() {
        if (!empty($_POST["logout"])) {
            if (file_exists("src/data/admin.json")) {
                $arr = json_decode(file_get_contents("src/data/admin.json"));
                $params = get_object_vars($arr[0]);
                if ($params["logged"]) {
                    $params["logged"] = false;
                    $arr[0] = $params;
                    file_put_contents("src/data/admin.json", json_encode($arr));
                    $this->view->redirect('/tasks/show');
                } else {
                    View::error("You aren't admin!");
                }
            }
        }

        $this->view->render();
    }
}