<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NoteForm
 * @package App\Http\Requests
 */
class NoteForm extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'text' => ['required', 'string', 'max:1000'],
        ];
    }
}
