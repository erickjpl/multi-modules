<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class BestSellerResource extends JsonResource
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
            'id' => (string) $this->getRouteKey(),
            'type' => 'products',
            'attributes' => [
                'id' => $this->id,
                'product' => $this->product,
                'most_selled' => $this->most_selled
            ],
            'links' => [
                'self' => route('api.products.show', $this->getRouteKey())
            ]
        ];
    }
}
