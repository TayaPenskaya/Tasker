<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Models\TaskerModel;

class TaskerController extends Controller {
    private TaskerModel $model;

    public function __construct($route) {
        parent::__construct($route);
        $this->model = new TaskerModel();
    }

    public function show() {
        if (!empty($_POST)) {
            if (!empty($_POST["name"]) & !empty($_POST["email"]) & !empty($_POST["text"])) {
                $this->model->getTasker()->addTask($_POST["name"], $_POST["email"], $_POST["text"]);
            }
            for ($i = 0; $i < count($this->model->getTasker()->getTaskList()); ++$i) {
                if (isset($_POST["check-is-done-".$i])) {
                    $this->model->getTasker()->editStatus($this->model->getTasker()->getTask($i));
                }
                if (isset($_POST["delete-".$i])) {
                    $this->model->getTasker()->deleteTask($this->model->getTasker()->getTask($i));
                }
            }
            if (!empty($_POST["sort"])) {
                if ($_POST["sort"] == "name") {
                    $this->model->getTasker()->sortByName();
                } elseif ($_POST["sort"] == "email") {
                    $this->model->getTasker()->sortByEmail();
                } else {
                    $this->model->getTasker()->sortByStatus();
                }
            }
            $this->model->update();
        }
        $isAdmin = false;
        if (file_exists("src/data/admin.json")) {
            $arr = json_decode(file_get_contents("src/data/admin.json"));
            $params = get_object_vars($arr[0]);
            if ($params["logged"]) {
                $isAdmin = true;
            }
        }
        $params = ['tasks' => $this->model->getTasker()->getTaskList(), 'isAdmin' => $isAdmin];
        $this->view->render($params);
    }

}