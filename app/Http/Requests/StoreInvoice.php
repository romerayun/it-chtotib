<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreInvoice extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->role_id > 1)
            return false;
        else
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
            'number_invoice' => 'required',
            'date_invoice' => 'required|date',
            'price' => 'required|numeric',
            'supplier_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'number_invoice.required' => 'Поле номер счета не может быть пустым',
            'date_invoice.required' => 'Поле дата выставления счета не может быть пустым',
            'date_invoice.date' => 'Поле дата выставления счета должно быть в формате даты',
            'price.required' => 'Поле стоимость счета не может быть пустым',
            'price.numeric' => 'Поле стоимость счета должно быть в числовом формате',
            'supplier_id.required' => 'Поле поставщик оборудования не может быть пустым',
            'supplier_id.integer' => 'Выберите значение из списка',
        ];
    }
}
