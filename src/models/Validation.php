<?php declare(strict_types=1);


namespace App\Models;

use App\Models\Constants;
class Validation {

    public static function isValidEmail(string $email) : bool {
        return boolval(preg_match(Constants::emailRegex, $email));
    }

    public static function isValidName(string $name) : bool {
        return boolval(preg_match(Constants::nameRegex, $name));
    }

}