<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterForm
 * @package App\Http\Requests
 */
class RegisterForm extends FormRequest
{
    /**
     * Определите, авторизован ли пользователь сделать этот запрос.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;    // разрешить
    }

    /**
     * Правила валидации
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'name' => ['required', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
