<?php

namespace App\Http\Controllers;

use App\Models\RoomImage;
use App\Http\Requests\StoreRoomImageRequest;
use App\Http\Requests\UpdateRoomImageRequest;
use App\Http\Resources\RoomImageResource;

class RoomImageController extends Controller
{

    public function store(StoreRoomImageRequest $request)
    {
        $roomImage = RoomImage::create($request->validated());
        return $this->successResponse(RoomImageResource::make($roomImage));
    }

    public function destroy(RoomImage $roomImage)
    {
        $roomImage->delete();
        return $this->deletedResponse();
    }
}
