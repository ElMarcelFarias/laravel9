<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //se o usuário tem autorização para fazer isso
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        //validações

        return [
            'name' => 'required|string|max:255|min: 3',
            'email' => [
                'required',
                'email',
                'unique:users', //email unico na tabela users
            ],
            'password' => [
                'required', 
                'min:6',
                'max:15'
            ]
        ];
    }
}
