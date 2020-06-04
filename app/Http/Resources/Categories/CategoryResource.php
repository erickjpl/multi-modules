<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => (string) $this->getRouteKey(),
                'type' => 'categories',
                'attributes' => [
                    'id' => $this->id,
                    'category' => $this->category
                ],
                'links' => [
                    'self' => route('api.categories.show', $this->getRouteKey())
                ]
            ]
        ];
    }
}
