<?php

namespace App\Http\Requests\API\V1\Servicio;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|max:255',
            'icono' => 'required',
            'status',
        ];
    }
    
    public function messages()
    {
        return [
            'nombre.required'    => 'El nombre es requerido.',
        ];
    }
}
