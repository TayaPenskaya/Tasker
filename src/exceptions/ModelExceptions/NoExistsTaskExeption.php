<?php


namespace App\exceptions\ModelExceptions;


use Throwable;

class NoExistsTaskExeption extends \Exception {
    public function __construct($message = 'No such task in list of tasks', $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}