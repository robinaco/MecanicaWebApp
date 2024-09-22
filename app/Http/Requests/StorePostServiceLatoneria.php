<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostServiceLatoneria extends FormRequest
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
            'modelvh'=> 'required|not_in:0',
            'color'=> 'required|not_in:0',
            'nivel'=> 'required|not_in:0',
            'kms'=> 'required',
            'cost'=> 'required',
            'abono'=> 'required',
            'resta'=> 'required',
            'antena'=> 'required|not_in:0',
            'extintor'=> 'required|not_in:0',
            'gato'=> 'required|not_in:0',
            'llanta'=> 'required|not_in:0',
            'herramienta'=> 'required|not_in:0',
            'kit'=> 'required|not_in:0',
            'documentos'=> 'required|not_in:0',
            'radio'=> 'required|not_in:0',
            'parlantes'=> 'required|not_in:0',
            'tapetes'=> 'required|not_in:0',
            'encendedor'=> 'required|not_in:0',
            'espejos'=> 'required|not_in:0',
            'parasoles'=> 'required|not_in:0',
            'limpiabrisas'=> 'required|not_in:0',
            'bateria'=> 'required|not_in:0',
            'pintura'=> 'required|not_in:0',
            'suciedad'=> 'required|not_in:0',
            'fotos' => 'required',
            'fotos.*' => 'required|image|mimes:jpeg,png,jpg,heic',
            'nombreclentrega' => 'required',

        ];
    }
}
