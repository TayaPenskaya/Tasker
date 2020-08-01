<?php


namespace App\Exceptions\RouterExceptions;


use Throwable;

class NoSuchRouteException extends \Exception {
    public function __construct($message = "There is no such route.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}