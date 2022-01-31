<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'message' => 'required|string|min:3',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'A mensagem deve conter pelo menos 3 letras!',
        ];
    }

    public function attributes()
    {
        return [
            'message' => 'mensagem',
        ];
    }
}
