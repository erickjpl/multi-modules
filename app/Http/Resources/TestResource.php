<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class TestResource extends JsonResource
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
            'id' => (string) $this->resource->getRouteKey(),
            'type' => 'products',
            'attributes' => [
                'product' => $this->resource->product,
                'slug' => $this->resource->slug,
                'description' => $this->resource->description,
                'category_name' => $this->resource->category_name,
                'most_selled' => $this->resource->most_selled
            ],
            'links' => [
                'self' => route('test.show', $this->resource)
            ]
        ];
    }
}
