<?php

namespace app\forms;

use core\abstracts\Form;

/**
 * Class TestForm
 *
 * @package app\models\forms
 */
class TestForm extends Form
{

    /* @var int $id */
    public $id;

    /* @var string $posts */
    public $email;

    /**
     * @return array
     */
    public function validateRules(): array
    {
        return [
            ['attributes' => ['id', 'email'], 'validator' => 'required', 'message' => 'Поле не может быть пустым!'],
            ['attributes' => ['email'], 'validator' => ['trim', 'email']],
        ];
    }

}