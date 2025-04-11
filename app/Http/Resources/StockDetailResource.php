<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockDetailResource extends JsonResource
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
            'stock_detail_id' => $this->stock_detail_id,
            'stock' => $this->stock,
            'product_detail' => new ProductDetailResource($this->product_detail),
            'price_pay' => $this->price_pay,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'sale_off' => $this->sale_off,
            'quantity_pay' => (int)$this->quantity_pay,
            'quantity_rate' => (int)$this->quantity_rate,
            'avg_star' => (float)$this->avg_star,
        ];
    }
}
