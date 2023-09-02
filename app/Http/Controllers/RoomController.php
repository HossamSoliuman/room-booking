<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomBookResource;
use App\Http\Resources\RoomResource;
use App\Models\RoomImage;
use App\Traits\ManagesFiles;

class RoomController extends Controller
{
    use ManagesFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with('roomImages')->whereActivated(1)->orderBy('id', 'desc')->paginate(10);
        return $this->successResponse(RoomResource::collection($rooms));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $room = Room::create($data);
        $images = $data['images'];
        foreach ($images as $image) {
            $path = $this->uploadFile($image, Room::PATH);
            RoomImage::create([
                'room_id' => $room->id,
                'path' => $path,
            ]);
        }
        return $this->successResponse(RoomResource::make($room));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $room->load(['user', 'city', 'roomImages']);
        return $this->successResponse(RoomResource::make($room));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        if (auth()->id() != $room->user_id) {
            return $this->errorResponse('Unauthorized action', 401);
        }
        $room->update($request->validated());
        return $this->successResponse(RoomResource::make($room));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        if (auth()->id() != $room->user_id) {
            return $this->errorResponse('Unauthorized action', 401);
        }
        $room->delete();
        return $this->deletedResponse();
    }
    public function books(Room $room)
    {
        $room->load('roomBooks');
        return $this->successResponse(RoomBookResource::collection($room->roomBooks));
    }
}
