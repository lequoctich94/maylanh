<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'member_id' => $this->member_id,
            'rank' => new RankResource($this->rank),
            'user' => new UserResource($this->user),
            'addresses' => $this->addresses,
            'current_point' => $this->current_point,
            'date_start_rank' => Carbon::parse($this->date_start_rank, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'date_end_rank' => Carbon::parse($this->date_end_rank, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'status' => $this->status,
        ];
    }
}