<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
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
            'nameempleado' => 'required',
            'tdoctoempleado'=> 'required|not_in:0',
            'numerocedulaempleado' => 'required',
            'numerocelempleado' => 'required',
            'rolempleado'=>'required|not_in:0',
        ];
    }
}
