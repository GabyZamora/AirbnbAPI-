<?php

namespace App\Http\Requests\API\V1\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'icono' => '',
            'estado',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'    => 'El nombre es requerido.',
            'descripcion.required'    => 'La descripcion es requerido.',
        ];
    }
}
