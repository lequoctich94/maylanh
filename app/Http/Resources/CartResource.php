<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Cart;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'cart_id' => $this->cart_id,
            'product_detail' => new ProductDetailResource($this->product_detail),
            'member' => new MemberResource($this->member),
            'quantity' => $this->quantity,
            'price_pay' => $this->price_pay
        ];
    }
}
