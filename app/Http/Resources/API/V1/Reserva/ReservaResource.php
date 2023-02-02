<?php

namespace App\Http\Resources\API\V1\Reserva;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'checkin' => $this->checkin,
            'checkout' => $this->checkout,
            'lugar' => [
                'lugar_id' => $this->lugar->id,
                'nombre' => $this->lugar->nombre,
                'precio' => $this->lugar->precio,
            ],
            'numerohuesped' => $this->numhuesped,
            'preciototal' => $this->preciototal,
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