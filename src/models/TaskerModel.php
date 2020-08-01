<?php


namespace App\Models;


class TaskerModel {
    private Tasker $tasker;

    public function __construct() {
        if (file_exists('src/data/tasks.json')) {
            $json = file_get_contents('src/data/tasks.json');
            $this->tasker = Tasker::jsonDeserialize($json);
        } else {
            $this->tasker = new Tasker();
            //ToDo == error or create file
        }
    }

    public function getTasker(): Tasker {
        return $this->tasker;
    }

    public function update() {
        if (file_exists('src/data/tasks.json')) {
            $json = $this->tasker->jsonSerialize();
            $file = 'src/data/tasks.json';
            file_put_contents($file, $json);
        }
    }

}