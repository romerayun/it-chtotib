<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettings extends FormRequest
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
            'photo' => 'nullable|image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле имя пользователя не может быть пустым',
            'photo.image' => 'Загружаемый файл должен быть в формате (jpeg, png, bmp, gif, svg, webp)',
        ];
    }
}
