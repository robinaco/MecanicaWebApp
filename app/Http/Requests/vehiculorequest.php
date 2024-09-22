<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vehiculorequest extends FormRequest
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
           
            'marca'=> 'required|not_in:0',
            'placa' => 'required',
            'ref' => 'required',
            'kms' => 'required',
            'modelvh'=> 'required|not_in:0',
            'color'=>'required|not_in:0',
        ];
    }
}
