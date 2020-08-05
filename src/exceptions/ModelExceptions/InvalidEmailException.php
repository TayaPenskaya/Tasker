<?php


namespace App\exceptions\ModelExceptions;


use Throwable;

class InvalidEmailException extends \Exception {
    public function __construct($email, $message = "Invalid email: ", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message . $email, $code, $previous);
    }

}