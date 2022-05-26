<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSupplier extends FormRequest
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
            'title' => 'required',
            'address' => 'required',
            'inn' => 'required|integer',
            'ogrnip' => 'required|integer',
            'rs' => 'required',
            'rs_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле наименование поставщика не может быть пустым',
            'address.required' => 'Поле юридический адрес поставщика не может быть пустым',
            'inn.required' => 'Поле ИНН поставщика не может быть пустым',
            'inn.integer' => 'Поле ИНН поставщика должно быть числовым',
            'ogrnip.required' => 'Поле ОГРНИП поставщика не может быть пустым',
            'ogrnip.integer' => 'Поле ОГРНИП поставщика должно быть числовым',
            'rs.required' => 'Поле расчетный счет поставщика не может быть пустым',
            'rs_name.required' => 'Поле наименование банка не может быть пустым',
        ];
    }
}
