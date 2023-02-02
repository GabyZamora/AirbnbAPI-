<?php 
namespace App\Http\Requests\API\V1\Lugar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLugarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
            'user_id',
            'categoria_id',
            'direccion',
            'numhuesped',
            'precio',
            'estado'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'descripcion.required' => 'La descripcion es requerida',
        ];
    }
}