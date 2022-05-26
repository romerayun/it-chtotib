<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле имя не может быть пустым',
            'email.required' => 'Поле email не может быть пустым',
            'email.email' => 'Поле email должно быть в формате example@test.com',
            'email.unique' => 'Такой пользователь уже существует',
            'password.required' => 'Поле пароль не может быть пустым',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
