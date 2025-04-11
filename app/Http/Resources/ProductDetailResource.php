<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'product_detail_id' => $this->product_detail_id,
            'product' => new ProductResource($this->product),
            'size' => new SizeResource($this->size),
            'color' => $this->color,
            'price_produced' => $this->price_produced,
            'status' => $this->status,
        ];
    }
}
