<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
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
            'favourite_id' => $this->favourite_id,
            'member' => new MemberResource($this->member),
            'product_detail' => new ProductDetailResource($this->product_detail),
        ];
    }
}
