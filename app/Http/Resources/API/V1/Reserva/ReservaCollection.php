<?php

namespace App\Http\Resources\API\V1\Reserva;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReservaCollection extends ResourceCollection
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
            'type' => 'Lugares'
        ];
    }
}
