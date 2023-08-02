<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'id'=> $this->id,
			'activated'=> $this->activated,
			'title'=> $this->title,
			'description'=> $this->description,
			'city_id'=> $this->city_id,
			'location'=> $this->location,
			'user_id'=> $this->user_id,
			'price_per_day'=> $this->price_per_day,
			'number_of_beds'=> $this->number_of_beds,

            'created_at' => $this->created_at,
            'last_update' => $this->updated_at,
        ];
    }
}
