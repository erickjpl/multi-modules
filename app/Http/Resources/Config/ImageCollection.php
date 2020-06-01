<?php

namespace App\Http\Resources\Config;

use App\Http\Resources\Config\ImageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ImageCollection extends ResourceCollection
{
    public $collects = ImageResource::class;
    
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
            ]
        ];
    }
}
