<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'descripcionproducto' => 'required',
            'codigo' => 'required',
            'categoriaproduct'=> 'required|not_in:0',
            'cantidadproducto' => 'required',
            'valorcompraproducto' => 'required',
            'valorventaproducto'=>'required',
        ];
    }
}
