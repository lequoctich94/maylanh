<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityHistoryResource extends JsonResource
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
            'id' => $this->id,
            'activity' => $this->activity,
            'object_id' => $this->object_id,
            'date_created' => Carbon::parse($this->date_created, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'user' => new UserResource($this->user),
            'type' => $this->type,
        ];
    }
}
