<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaim extends FormRequest
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
            'fio' => 'required',
            'email' => 'required|email',
            'location' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fio.required' => 'Поле ФИО не может быть пустым',
            'email.required' => 'Поле email не может быть пустым',
            'email.email' => 'Поле email должно быть в формате info@example.ru',
            'location.required' => 'Поле местоположение не может быть пустым',
            'description.required' => 'Поле описание заявки не может быть пустым',
        ];
    }
}
