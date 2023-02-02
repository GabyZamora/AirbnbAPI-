<?php

namespace App\Http\Resources\API\V1\Categoria;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'icono' => $this->icono,
            'estado' => $this->estado,
            'created_at' => $this->created_at->format('d/m/Y'),
            /*'author' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],*/
        ];
    }
}
