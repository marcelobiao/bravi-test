<?php

namespace App\Http\Requests\Phone;

use Illuminate\Foundation\Http\FormRequest;

class CreatePhoneRequest extends FormRequest
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
            'number' => ['required', 'numeric', 'regex:/[0-9]{8,13}/'],
            'isWhatsapp' => ['required', 'boolean']
        ];
    }
}