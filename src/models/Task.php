<?php declare(strict_types=1);
namespace App\models;

use App\exceptions\ModelExceptions\InvalidEmailException;
use App\exceptions\ModelExceptions\InvalidNameException;

class Task {
    private string $name;
    private string $email;
    private string $text;
    private bool $isDone;

    public function __construct(string $name, string $email, string $text, bool $isDone = false) {
        $this->email = $email;
        $this->name = $name;
        $this->text = $text;
        $this->isDone = $isDone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getIsDone() : bool {
        return $this->isDone;
    }

    public static function createTask(string $name, string $email, string $text) {
        if (Validation::isValidName($name)) {
            if (Validation::isValidEmail($email)) {
                return new Task($name, $email, $text);
            }
            throw new InvalidEmailException($email);
        }
        throw new InvalidNameException($name);
    }

    public function editText(string $newText) : void {
        $this->text = $newText;
    }

    public function editStatus() : void {
        $prev = $this->isDone;
        $this->isDone = !$prev;
    }

    public function getObjectVars() {
        return get_object_vars($this);
    }

}