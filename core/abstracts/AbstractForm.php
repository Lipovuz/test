<?php

namespace core\abstracts;

use core\patterns\ValidatorFactory;
use ReflectionClass;
use ReflectionProperty;

/**
 * Class Form
 *
 * @package core\base
 */
abstract class Form
{

    /* @var array */
    private $errors = [];

    /* @var ValidatorFactory $factory */
    private $validatorFactory;

    /**
     * Form constructor.
     */
    public function __construct()
    {
        $this->validatorFactory = new ValidatorFactory();
    }

    /**
     * @return array
     */
    abstract public function validateRules(): array;

    /**
     * @param $data
     *
     * @return bool
     */
    public function load($data): bool
    {
        if (!empty($data)) {
            $this->setAttributes($data);

            return true;
        }

        return false;
    }

    /**
     * @param null $names
     * @param array $except
     *
     * @return array
     */
    public function getAttributes($names = null, $except = []): array
    {
        $values = [];

        if ($names === null) {
            $names = $this->attributes();
        }

        foreach ($names as $name) {
            $values[$name] = $this->$name;
        }

        foreach ($except as $name) {
            unset($values[$name]);
        }

        return $values;
    }

    /**
     * @param $values
     */
    public function setAttributes($values): void
    {
        if (is_array($values)) {
            $attributes = array_flip($this->attributes());
            foreach ($values as $name => $value) {
                if (isset($attributes[$name])) {
                    $this->$name = $value;
                }
            }
        }
    }

    /**
     * @return array
     */
    private function attributes(): array
    {
        $class = new ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $names[] = $property->getName();
            }
        }

        return $names;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $rules = $this->validateRules();
        $this->validatorFactory->init($rules);

        foreach ($rules as $rule) {
            foreach ($rule['attributes'] as $attribute) {
                if (is_array($rule['validator'])) {
                    foreach ($rule['validator'] as $validator) {
                        $this->validationAttribute($attribute, $rule, $validator);
                    }
                } else {
                    $this->validationAttribute($attribute, $rule, $rule['validator']);
                }
            }
        }

        if(empty($this->getAllErrors())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getAllErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param $attribute
     *
     * @return mixed|null
     */
    public function getError($attribute) :? array
    {
        return isset($this->errors[$attribute]) ? $this->errors[$attribute] : null;
    }

    /**
     * @param $attribute
     *
     * @param $message
     */
    public function setError($attribute, $message): void
    {
        $this->errors[$attribute] = $message;
    }

    private function validationAttribute($attribute, array $rule, string $validator_name): void
    {
        $validator = $this->validatorFactory->factory($validator_name);

        if(!$validator->validate($this->$attribute)) {
            $this->setError($attribute, $rule['message'] ?: $validator->getMessage());
        }
    }

}