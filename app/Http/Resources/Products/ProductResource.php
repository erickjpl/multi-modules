<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Config\ImageCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Inventories\InventoryCollection;
use App\Http\Resources\Config\ImageRelationshipsCollection;
use App\Http\Resources\Relationships\Config\ImageCollection as ImageRelation;
use App\Http\Resources\Relationships\Categories\CategoryResource as CategoryRelation;
use App\Http\Resources\Relationships\Inventories\InventoryCollection As InventoryRelation;

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
                    CategoryRelation::make( $this->category )
                ],
                'images' => [
                    ImageRelation::make( $this->images )
                ],
                'inventories' => [
                    InventoryRelation::make( $this->availableInventories )
                ]
            ],
            'included' => [
                'categories' => CategoryResource::make( $this->category ),
                'images' => ImageCollection::make( $this->images ),
                'inventories' => InventoryCollection::make( $this->availableInventories )
            ],
            'links' => [
                'self' => route('api.products.show', $this->getRouteKey())
            ]
        ];
    }
}
