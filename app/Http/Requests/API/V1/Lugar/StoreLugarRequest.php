<?php

namespace App\Http\Requests\API\V1\Lugar;

use Illuminate\Foundation\Http\FormRequest;

class StoreLugarRequest extends FormRequest
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
            'user_id',
            'categoria_id',
            'direccion',
            'numhuesped',
            'precio',
            'imagen',
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
