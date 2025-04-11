<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillOrderDetailResource extends JsonResource
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
            'bill_order_detail_id' => $this->bill_order_detail_id,
            'product_detail' => new ProductDetailResource($this->product_detail),
            'bill_order' => new BillOrderResource($this->bill_order),
            'quantity' => $this->quantity,
            'price_order' => $this->price_order,
            'price_pay' => $this->price_pay,
            'total_price' => $this->total_price,

        ];
    }
}