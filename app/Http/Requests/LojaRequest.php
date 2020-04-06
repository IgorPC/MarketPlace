<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LojaRequest extends FormRequest
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
            'nome' => 'required',
            'descricao' => 'required|min:10',
            'celular' => 'required',
            'telefone' => 'required',
            'logo' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Esse campo é obrigatorio',
            'min' => 'Esse campo deve ter no minimo :min caracteres',
            'image' => 'O arquivo adicionado não é uma imagem valida'
        ];
    }
}
