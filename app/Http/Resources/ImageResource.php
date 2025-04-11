<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'img_id' => $this->img_id,
            'img_name' => $this->img_name,
            'product' => new ProductResource($this->product),
            'color' => new ColorResource($this->color),
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'updated_at' => Carbon::parse($this->updated_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
        ];
    }
}
