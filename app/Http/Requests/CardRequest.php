<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
            'number' => 'required|size:20|regex:/^[0-9]+$/',
            'pin' => 'required|size:4',
            'balance' => 'required|numeric|between:10,99999.99',
            'activation' => 'required',
            'validity' => 'required',
        ];
    }
}
