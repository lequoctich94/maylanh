<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            'rate_id' => $this->rate_id,
            'member' => new MemberResource($this->member),
            'product' => new ProductResource($this->product),
            'star' => $this->star,
            'status' => $this->status,
            'comment' => $this->comment,
            'like' => $this->like,
            'date_rate' => Carbon::parse($this->date_rate, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
        ];
    }
}
