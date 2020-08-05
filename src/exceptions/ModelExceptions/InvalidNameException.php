<?php


namespace App\exceptions\ModelExceptions;


use Throwable;

class InvalidNameException extends \Exception {
    public function __construct($name, $message = "Invalid name: ", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message . $name, $code, $previous);
    }
}