<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'email' => 'required|email|min:3',
            'password' => 'required|string|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome deve conter pelo menos 3 letras!',
            'email.required' => 'O email deve conter pelo menos 3 letras!',
            'password.required' => 'A senha deve conter pelo menos 3 letras!',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'password' => 'senha',
        ];
    }
}
