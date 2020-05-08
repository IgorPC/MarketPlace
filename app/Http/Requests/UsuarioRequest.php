<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'street' => 'required',
            'number' => 'required',
            "district" => 'required',
            "city" => 'required',
            "state" => 'required',
            "country" => 'required',
            "complement" => 'required',
            "celphone" => 'required',
            "phone" => 'required',
            "doc" => 'required|min:10',
            'postalcode' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Esse campo é obrigatorio',
            'min' => 'Digite um documento valido',
        ];
    }
}
