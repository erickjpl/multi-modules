<?php

namespace App\Http\Resources;

use App\Http\Resources\TestResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TestCollection extends ResourceCollection
{
    public $collects = TestResource::class;

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
            'links' => [
                'self' => route('test.index')
            ],
            'meta' => [
                'products_count' => $this->collection->count()
            ]
        ];
    }
}
