<?php

namespace core\abstracts;

/**
 * Class AbstractValidator
 *
 * @package core\abstracts
 */
abstract class AbstractValidator
{
    /**
     * @return string
     */
    abstract public static function name(): string;

    /**
     * @param $value
     *
     * @return mixed
     */
    abstract public function validate($value): bool;

    /**
     * @return string
     */
    abstract public function getMessage(): string;

}