<?php

namespace core\validators;

use core\abstracts\AbstractValidator;

/**
 * Class RequiredValidator
 *
 * @package core\validators
 */
class RequiredValidator extends AbstractValidator
{

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'required';
    }

    /**
     * @param $value
     *
     * @return bool|mixed|string
     */
    public function validate($value): bool
    {
        return !empty($value);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return "Поле не может быть пустым";
    }

}