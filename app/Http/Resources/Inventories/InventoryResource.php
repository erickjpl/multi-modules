<?php

namespace App\Http\Resources\Inventories;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
            'type' => 'inventories',
            'attributes' => [
                'quantity' => $this->quantity,
                'promotion' => $this->promotion,
                'discount' => $this->discount,
                'price' => $this->price,
                'status' => $this->status,
                'observation' => $this->observation
            ]
        ];
    }
}
