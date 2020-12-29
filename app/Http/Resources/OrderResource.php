<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name'=> $this->last_name,
            'email'=> $this->email,
            'post_code'=> $this->post_code,
            'address'=> $this->address,
            'tel'=> $this->tel,
            'mobile'=> $this->mobile,
            'order_detail' => OrderDetailResource::collection($this->order_detail),
        ];
    }
}
