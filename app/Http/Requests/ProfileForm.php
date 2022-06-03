<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfileForm
 * @package App\Http\Requests
 */
class ProfileForm extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,id,' . $this->get('id')],
            'name' => ['required', 'string', 'max:100'],
            'local_path' => ['nullable'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
