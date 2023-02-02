<?php

namespace App\Http\Resources\API\V1\Servicio;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicioResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'icono' => $this->icono,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d/m/Y'),
            /*'author' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],*/
        ];
    }
}
