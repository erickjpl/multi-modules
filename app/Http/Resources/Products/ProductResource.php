<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Config\ImageCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Inventories\InventoryCollection As InventoryExt;
use App\Http\Resources\Config\ImageRelationshipsCollection;

class ProductResource extends JsonResource
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
                'slug' => $this->slug,
                'description' => $this->description
            ],
            'relationships' => [
                'categories' => [
                    'data' => [
                        'id' => $this->category->getRouteKey(),
                        'type' => 'categories',
                    ],
                    'links' => [
                        'related' => route('api.categories.show', $this->category->getRouteKey())
                    ]
                ],
                'images' => [
                    ImageRelationshipsCollection::make( $this->images )
                ],
                'inventories' => [
                    InventoryCollection::make( $this->availableInventories )
                ]
            ],
            'included' => [
                'categories' => CategoryResource::make( $this->category ),
                'images' => ImageCollection::make( $this->images ),
                'inventories' => InventoryExt::make( $this->availableInventories )
            ],
            'links' => [
                'self' => route('api.products.show', $this->getRouteKey())
            ]
        ];
    }
}
