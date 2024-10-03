<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreToolRequest extends FormRequest
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
            'descripciontool' => 'required',
            'categoriatool'=> 'required|not_in:0',
            'cantidadtool' => 'required',
            'valorcompratool' => 'required',
            'valorventatool'=>'required',
        ];
    }
}
