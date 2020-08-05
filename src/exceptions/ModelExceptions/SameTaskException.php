<?php


namespace App\exceptions\ModelExceptions;


use Throwable;

class SameTaskException extends \Exception {
    public function __construct($message = 'There are exactly the same task in list of tasks.', $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}