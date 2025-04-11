<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProducerResource extends JsonResource
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
            'producer_id' => $this->producer_id,
            'producer_name' => $this->producer_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status
        ];
    }
}
