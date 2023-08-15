<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomBookResource extends JsonResource
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
            'user' => UserResource::make($this->whenLoaded('user')),
            'room' => RoomResource::make($this->whenLoaded('room')),
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,

            'created_at' => $this->created_at,
            'last_update' => $this->updated_at,
        ];
    }
}
