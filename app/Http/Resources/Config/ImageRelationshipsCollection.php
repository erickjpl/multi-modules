<?php

namespace App\Http\Resources\Config;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Config\ImageRelationshipsResource;

class ImageRelationshipsCollection extends ResourceCollection
{
    public $collects = ImageRelationshipsResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
