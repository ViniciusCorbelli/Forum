<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'subtitle' => 'required|string|min:3',
            'message' => 'required|string|min:3',
            'abstract' => 'required|string|min:3',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O título deve conter pelo menos 3 letras!',
            'subtitle.required' => 'O subtítulo deve conter pelo menos 3 letras!',
            'message.required' => 'A mensagem deve conter pelo menos 3 letras!',
            'abstract.required' => 'O resumo deve conter pelo menos 3 letras!',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'título',
            'subtitle' => 'subtítulo',
            'message' => 'mensagem',
            'abstract' => 'resumo',
        ];
    }
}
