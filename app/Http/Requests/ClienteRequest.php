<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'codigo'=>'required|unique:clientes,codigo,'.$this->codigo.',codigo'
        ];
    }
    public function messages()
    {
     return [
         'codigo.required'=>'El :attribute no debe estar Vacío'
     ];   
    }
    public function attributes()
    {
        return [
            'codigo'=>'Código'
        ];
    }
}
