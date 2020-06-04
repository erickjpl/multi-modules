<?php

namespace App\Http\Resources\Config;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageRelationshipsResource extends JsonResource
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
            'type' => 'images',
        ];
    }
}