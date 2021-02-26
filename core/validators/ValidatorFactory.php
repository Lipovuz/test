<?php

namespace core\validators;

use core\abstracts\AbstractValidator;
use http\Exception\InvalidArgumentException;

/**
 * Class ValidatorFactory
 *
 * @package core\patterns
 */
final class ValidatorFactory
{

    /* @var array $types */
    private $types;

    /* @var array */
    private $validatorsList = [
        'required' => RequiredValidator::class,
        'email'    => EmailValidator::class,
        'trim'     => TrimValidator::class,
    ];

    /**
     * @param string $type
     *
     * @return AbstractValidator
     */
    public function factory(string $type): AbstractValidator
    {
        if(isset($this->types[$type])) {
            return new $this->types[$type];
        } else {
            throw new InvalidArgumentException('unknown type given');
        }
    }

    /**
     * @param array $rules
     */
    public function init(array $rules): void
    {
        foreach ($rules as $rule) {
            if (isset($this->validatorsList[$rule['validator']])) {
                $this->types[$rule['validator']] = $this->validatorsList[$rule['validator']];
            } else {
                throw new InvalidArgumentException('unknown validator "' . $rule['validator'] . '"');
            }
        }
    }

}
