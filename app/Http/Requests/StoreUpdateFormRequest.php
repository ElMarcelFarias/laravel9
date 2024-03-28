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

        //como pegar o id para fazer a validação 
        //dd($this->segment(2)); //segment(2) ele pega os parametros da url por um index ou $this->id

        $id = $this->id ?? '';

        $rules = [
            'name' => 'required|string|max:255|min: 3',
            'email' => [
                'required',
                'email',
                "unique:users,email,{$id},id",
            ],
            'password' => [
                'required', 
                'min:6',
                'max:15'
            ],
            'image' => [
                'nullable',
                'image',
                'max:2048'
            ],
        ];  

        if($this->method('PUT')) {
            $rules['password'] = [
                'nullable', 
                'min:6',
                'max:15'
            ];
        }

        return $rules;
    }
}
