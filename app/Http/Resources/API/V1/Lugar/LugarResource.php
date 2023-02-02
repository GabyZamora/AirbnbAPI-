<?php

namespace App\Http\Resources\API\V1\Lugar;

use Illuminate\Http\Resources\Json\JsonResource;

class LugarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'categoria' => [
                'categoria_id' => $this->categoria->id,
                'nombre' => $this->categoria->nombre,
                'icono' => $this->categoria->icono,
            ],
            'direccion' => $this->direccion,
            'numerohuesped' => $this->numhuesped,
            'precio' => $this->precio,
            'imagen' => $this->imagen,
            'estado' => $this->estado,
            'author' => [
                'id' => $this->user->id,
                'user' => $this->user->name,
                'email' => $this->user->email,
            ],
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}