<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistory extends FormRequest
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
            'status_id' => 'required|integer',
            'location_id' => 'required|integer',
            'comment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'status_id.required' => 'Поле основание перемещения не может быть пустым',
            'location_id.required' => 'Поле местоположение не может быть пустым',
            'comment.required' => 'Поле комментарий не может быть пустым',
            'location_id.integer' => 'Выберите значение из списка',
            'status_id.integer' => 'Выберите значение из списка',
        ];
    }
}
