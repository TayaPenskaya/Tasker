<?php


namespace App\controllers;


use App\core\Controller;
use App\core\View;

class AccountController extends Controller {

    public function login() {
        if (!empty($_POST)) {
            if (!empty($_POST["login"]) & !empty($_POST["password"])) {
                $login = $_POST["login"];
                $pass = $_POST["password"];
                if (file_exists("src/data/admin.json")) {
                    $arr = json_decode(file_get_contents("src/data/admin.json"));
                    $params = get_object_vars($arr[0]);
                    if ($login == $params["login"] & $pass == $params["password"]) {
                        $params["logged"] = true;
                        $arr[0] = $params;
                        file_put_contents("src/data/admin.json", json_encode($arr));
                        $this->view->redirect("/admin/hello");
                    }
                }
                View::error("Incorrect data in order to log in.");
            }
        }
        $isAdmin = false;
        if (file_exists("src/data/admin.json")) {
            $arr = json_decode(file_get_contents("src/data/admin.json"));
            $params = get_object_vars($arr[0]);
            if ($params["logged"]) {
                $isAdmin = true;
            }
        }
        if (!$isAdmin) {
            $this->view->render($params);
        } else {
            $this->view->redirect('/admin/logout');
        }
    }

}