<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObject extends FormRequest
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
            'inv_number' => 'nullable',
            'title' => 'required',
            'date_buy' => 'required|date',
            'price' => 'required|numeric',
            'type_id' => 'required|integer',
//            'abbr' => 'nullable|unique:App\Abbreviation,abbr',
            'invoice_id' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'inv_number.required' => 'Поле инвентарный номер не может быть пустым',
            'title.required' => 'Поле наименование не может быть пустым',
            'date_buy.required' => 'Поле дата покупки не может быть пустым',
            'date_buy.date' => 'Поле дата покупки должно быть в формате даты',
            'price.required' => 'Поле цена не может быть пустым',
            'price.numeric' => 'Поле цена должно быть в числовом формате',
            'type_id.required' => 'Поле тип оборудования не может быть пустым',
            'type_id.integer' => 'Выберите значение из списка',
            'invoice_id.integer' => 'Выберите значение из списка',
            'abbr.unique' => "Сокращенное имя уже используется"
        ];
    }
}
