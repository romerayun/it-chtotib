<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatus extends FormRequest
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
            'name' => 'required|min:1',
            'color' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле наименование статуса не может быть пустым',
            'color.required' => 'Выберите цвет статуса',
        ];
    }
}
