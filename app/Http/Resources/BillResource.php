<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
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
            'bill_id' => $this->bill_id,
            'member' => new MemberResource($this->member),
            'shipping_address' => $this->shipping_address,
            'shipping_phone' => $this->shipping_phone,
            'receiver' => $this->receiver,
            'voucher' => $this->voucher,
            'date_order' => $this->date_order,
            'date_confirm' => $this->date_confirm,
            'date_receipt' => $this->date_receipt,
            'date_delivery' => $this->date_delivery,
            'date_cancel' => $this->date_cancel,
            'total_price' => $this->total_price,
            'total_quantity' => $this->total_quantity,
            'payment' =>  $this->payment,
            'total_bill' => $this->total_bill,
            'quantity_bill' => $this->quantity_bill,
            'status' => $this->status,
            'message' => $this->message
        ];
    }
}