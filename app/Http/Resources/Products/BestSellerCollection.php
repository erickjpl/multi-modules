<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BestSellerCollection extends ResourceCollection
{
    public $collects = BestSellerResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'images_count' => $this->collection->count()
            ],
            'links' => [
                'self' => route('api.products.index')
            ]
        ];
    }
}
