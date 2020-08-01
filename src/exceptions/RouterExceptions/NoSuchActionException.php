<?php


namespace App\Exceptions\RouterExceptions;


class NoSuchActionException extends \Exception {
    public function __construct($action, $message = "There is no such action: ", $code = 0, Throwable $previous = null) {
        parent::__construct($message . $action, $code, $previous);
    }
}