<?php

namespace App\Http\Resources\API\V1\Servicio;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServicioCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'Organization' => 'Airbnb',
                'authors' => [
                    'Gabriela Zamora'
                ]
            ],
            'type' => 'Servicios'
        ];
    }
}
