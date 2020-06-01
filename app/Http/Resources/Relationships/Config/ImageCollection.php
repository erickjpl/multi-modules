<?php

namespace App\Http\Resources\Relationships\Config;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Relationships\Config\ImageResource;

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
            'data' => $this->collection
        ];
    }
}
