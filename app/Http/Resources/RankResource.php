<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RankResource extends JsonResource
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
            'rank_id' => $this->rank_id,
            'rank_name' => $this->rank_name,
            'point' => $this->point,
            'discount_categories' => $this->discount_categories,
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'updated_at' => Carbon::parse($this->updated_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
        ];
    }
}