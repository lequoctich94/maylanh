<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
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
            'code' => $this->code,
            'max_price' => $this->max_price,
            'max_used' => $this->max_used,
            'sale_off' => $this->sale_off,
            'date_start' => Carbon::parse($this->date_start, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'date_end' => Carbon::parse($this->date_end, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'status' => $this->status,
        ];
    }
}
