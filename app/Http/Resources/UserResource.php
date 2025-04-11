<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;

class UserResource extends JsonResource
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
            'user_id' => $this->user_id,
            'role' => new RoleResource($this->role),
            'username' => $this->username,
            'full_name' => $this->full_name,
            'birth_day' => $this->birth_day,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'image' => $this->image,
            'created_at' => Carbon::parse($this->created_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'updated_at' => Carbon::parse($this->updated_at, 'Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s'),
            'status' => $this->status,
            'token' => $this->token,
        ];
    }
}