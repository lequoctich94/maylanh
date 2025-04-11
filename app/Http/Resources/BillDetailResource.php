<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillDetailResource extends JsonResource
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
      'bill_detail_id' => $this->bill_detail_id,
      'product_detail' => new ProductDetailResource($this->product_detail),
      'bill' => new BillResource($this->bill),
      'quantity' => $this->quantity,
      'price' => $this->price,
      'total_price' => $this->total_price,
      'price_discount' => $this->price_discount,
      'rate_status' => $this->rate_status,
    ];
  }
}
