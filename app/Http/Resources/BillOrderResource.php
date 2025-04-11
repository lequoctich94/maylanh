<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BillOrderResource extends JsonResource
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
            'bill_order_id' => $this->bill_order_id,
            'amount' => $this->amount,
            'total_price' => $this->total_price,
            'date_order' => Carbon::parse($this->date_order, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'stock' => $this->stock,
            'producer' => $this->producer,
            'user' => $this->user,
        ];
    }
}
