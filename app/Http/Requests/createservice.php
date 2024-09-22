<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createservice extends FormRequest
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
           
            'operario' => 'required',
            'conceptomo' => 'required|not_in:0',
            'descmo' => 'required',
            'valor1' => 'required',
            'concepto' => 'required|not_in:0',
            'cantidad' => 'required',
        ];
    }
}
