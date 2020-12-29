<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'order_id' => $this->order_id,
            'product_name' => $this->product_name,
            'product_description' => $this->product_description,
            'product_image' => $this->product_image,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
