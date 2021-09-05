<?php

namespace App\Http\Requests\People;

use Illuminate\Foundation\Http\FormRequest;

class CreatePeopleRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255'],
        ];
    }

    /* public function messages()
    {
        return [
            '*.required' => 'O campo :attribute é obrigatório.',
            '*.numeric' => 'O campo :attribute precisa ser um número.',
            '*.exists' => 'O valor selecionado de :attribute é inválido.',
            '*.date' => 'O campo :attribute precisa estar no formato de data'
        ];
    }

    public function attributes()
    {
        return [
            'slug' => 'Mapa',
        ];
    } */
}
