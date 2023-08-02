<?php

namespace App\Http\Controllers;

use App\Models\RoomImage;
use App\Http\Requests\StoreRoomImageRequest;
use App\Http\Requests\UpdateRoomImageRequest;
use App\Http\Resources\RoomImageResource;

class RoomImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomImages = RoomImage::all();
        return $this->successResponse(RoomImageResource::collection($roomImages));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomImageRequest $request)
    {
        $roomImage = RoomImage::create($request->validated());
        return $this->successResponse(RoomImageResource::make($roomImage));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomImage  $roomImage
     * @return \Illuminate\Http\Response
     */
    public function show(RoomImage $roomImage)
    {
        return $this->successResponse(RoomImageResource::make($roomImage));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomImageRequest  $request
     * @param  \App\Models\RoomImage  $roomImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomImageRequest $request, RoomImage $roomImage)
    {
        $roomImage->update($request->validated());
        return $this->successResponse(RoomImageResource::make($roomImage));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomImage  $roomImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomImage $roomImage)
    {
        $roomImage->delete();
        return $this->deletedResponse();
    }
}
