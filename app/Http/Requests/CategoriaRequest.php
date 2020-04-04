<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
            'nomeCategoria' => 'required',
            'descricao' => 'required|min:10',
            'slug' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Esse campo é obrigatorio',
            'min' => 'Esse campo deve ter no minimo :min caracteres'
        ];
    }
}
