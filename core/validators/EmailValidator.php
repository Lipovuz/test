<?php

namespace core\validators;

use core\abstracts\AbstractValidator;

/**
 * Class EmailValidator
 *
 * @package core\validators
 */
class EmailValidator extends AbstractValidator
{

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'email';
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value): bool
    {
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return 'Неверный адрес электронной почты';
    }

}