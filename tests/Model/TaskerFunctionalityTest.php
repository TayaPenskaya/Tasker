<?php
namespace App\Tests\Model;

use App\models\Constants;
use App\models\Task;
use App\models\Tasker;
use PHPUnit\Framework\TestCase;
class TaskerFunctionalityTest extends TestCase {

    public function testTaskerFunctionality() {
        $tasker = Tasker::init();

        $this->assertEquals(Constants::happyMessage, $tasker->addTask('taya', 'taya@mail.com', 'Hello!'));

        $tasker->editTaskText($tasker->getTaskList()[0], 'Hi!');
        $this->assertEquals([new Task('taya', 'taya@mail.com', 'Hi!')], $tasker->getTaskList());

        $tasker->editStatus($tasker->getTaskList()[0]);
        $this->assertEquals(true, $tasker->getTaskList()[0]->getIsDone());

        $tasker->deleteTask($tasker->getTaskList()[0]);
        $this->assertEquals([], $tasker->getTaskList());
    }

}