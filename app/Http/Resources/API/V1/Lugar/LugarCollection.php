<?php

namespace App\Http\Resources\API\V1\Lugar;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LugarCollection extends ResourceCollection
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
