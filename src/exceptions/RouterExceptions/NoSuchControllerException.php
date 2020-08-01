<?php


namespace App\Exceptions\RouterExceptions;


use Throwable;

class NoSuchControllerException extends \Exception {
    public function __construct($controller, $message = "There is no such controller: ", $code = 0, Throwable $previous = null) {
        parent::__construct($message . $controller, $code, $previous);
    }
}