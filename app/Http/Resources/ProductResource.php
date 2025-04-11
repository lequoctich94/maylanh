<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Uuid\Type\Integer;

class ProductResource extends JsonResource
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
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'category' => $this->category,
            'producer' => $this->producer,
            'description' => $this->description,
            'status' => $this->status,
            'product_img' => $this->product_img,
            'list_image' => $this->images,
            'created_at' => Carbon::parse($this->created_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'updated_at' => Carbon::parse($this->updated_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'price_pay' => $this->price_pay,
            'quantity_pay' => $this->quantity_pay,
            'quantity_rate' => $this->quantity_rate,
            'avg_star' => $this->avg_star,
            'quantity_favourites' => $this->quantity_favourites
        ];
    }
}