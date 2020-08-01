<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\View;

class AccountController extends Controller {

    public function login() {
        if (!empty($_POST)) {
            if (!empty($_POST["login"]) & !empty($_POST["password"])) {
                $login = $_POST["login"];
                $pass = $_POST["password"];
                if (file_exists("src/data/admin.json")) {
                    $arr = json_decode(file_get_contents("src/data/admin.json"));
                    for ($i = 0; $i < count($arr); ++$i) {
                        $params = get_object_vars($arr[$i]);
                        if ($login == $params["login"] & $pass == $params["password"]) {
                            $this->view->redirect("/admin/hello");
                        }
                    }
                }
                View::error("Incorrect data in order to log in.");
            }
        }
        $this->view->render();
    }

}