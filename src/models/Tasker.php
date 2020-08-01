<?php declare(strict_types=1);


namespace App\Models;

use App\Core\View;
use App\Exceptions\ModelExceptions\NoExistsTaskExeption;
use App\Exceptions\ModelExceptions\SameTaskException;
use Exception;

class Tasker {
    private array $taskList;

    public function __construct($taskList = []) {
        $this->taskList = $taskList;
    }

    public function getTaskList(): array {
        return $this->taskList;
    }

    public static function init() : Tasker {
        return new Tasker();
    }

    public function getTask($i) : Task {
        return $this->taskList[$i];
    }

    public function addTask(string $name, string $email, string $text) : string {
        try {
            $task = Task::createTask($name, $email, $text);
            if (!in_array($task, $this->taskList)) {
                $this->taskList[] = $task;
                return Constants::happyMessage;
            }
            throw new SameTaskException();
        } catch (Exception $e) {
            View::error($e->getMessage());
        }
    }

    public function deleteTask(Task $task) : string {
        try {
            if (in_array($task, $this->taskList)) {
                $key = array_search($task, $this->taskList);
                array_splice($this->taskList, $key, 1);
                return Constants::happyMessage;
            }
            throw new NoExistsTaskExeption();
        } catch (Exception $e) {
            View::error($e->getMessage());
        }
    }

    public function editTaskText(Task $task, string $text) : void {
        $task->editText($text);
    }

    public function editStatus(Task $task) : void {
        $task->editStatus();
    }

    public function jsonSerialize() {
        $arr = [];
        foreach ($this->getTaskList() as $task) {
            $arr[] = $task->getObjectVars();
        }
        return json_encode($arr);
    }

    public static function jsonDeserialize($json) {
        $arr = json_decode($json);
        $tasks = [];
        foreach ($arr as $value) {
            $tasks[] = new Task($value->{"name"}, $value->{"email"}, $value->{"text"}, $value->{"isDone"});
        }
        return new Tasker($tasks);
    }

    public function sortByName() {
        usort($this->taskList, function ($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });
    }

    public function sortByEmail() {
        usort($this->taskList, function ($a, $b) {
            return strcmp($a->getEmail(), $b->getEmail());
        });
    }

    public function sortByStatus() {
        usort($this->taskList, function ($a, $b) {
            if ($a->getIsDone() == $b->getIsDone()) {
                return 0;
            }
            return ($a->getIsDone() > $b->getIsDone()) ? -1 : 1;
        });
    }
}