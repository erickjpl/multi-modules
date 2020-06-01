<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Config\ImageCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Inventories\InventoryCollection;
use App\Http\Resources\Config\ImageRelationshipsCollection;
use App\Http\Resources\Relationships\Config\ImageCollection as ImageExt;
use App\Http\Resources\Relationships\Inventories\InventoryCollection As InventoryExt;

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
        $category = $this->category;
        $images = $this->images;
        $availableInventories = $this->availableInventories;

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
                        'id' => $category->getRouteKey(),
                        'type' => 'categories',
                    ],
                    'links' => [
                        'related' => route('api.categories.show', $category->getRouteKey())
                    ]
                ],
                'images' => [
                    ImageExt::make( $images )
                ],
                'inventories' => [
                    InventoryExt::make( $availableInventories )
                ]
            ],
            'included' => [
                'categories' => CategoryResource::make( $category ),
                'images' => ImageCollection::make( $images ),
                'inventories' => InventoryCollection::make( $availableInventories )
            ],
            'links' => [
                'self' => route('api.products.show', $this->getRouteKey())
            ]
        ];
    }
}
