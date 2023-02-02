<?php

namespace App\Http\Resources\API\V1\Categoria;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
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
            'type' => 'Categorias'
        ];
    }
}
