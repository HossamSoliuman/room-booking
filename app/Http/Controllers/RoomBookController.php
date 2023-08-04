<?php

namespace App\Http\Controllers;

use App\Models\RoomBook;
use App\Http\Requests\StoreRoomBookRequest;
use App\Http\Requests\UpdateRoomBookRequest;
use App\Http\Resources\RoomBookResource;
use App\Services\RoomBookingService;
use Illuminate\Http\Response;

class RoomBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomBooks = RoomBook::all();
        return $this->successResponse(RoomBookResource::collection($roomBooks));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomBookRequest $request)
    {
        $ValidData = $request->validated();
        $ValidData['user_id'] = auth()->id();
        $isDateValid = (new RoomBookingService)
            ->checkBookingDate($ValidData['check_in'], $ValidData['check_out'], $ValidData['room_id']);
        if (!$isDateValid) {
            return $this->errorResponse('Invalid check-in or check-out dates. The selected range conflicts with another booked room.', Response::HTTP_FORBIDDEN);
        }
        $roomBook = RoomBook::create($ValidData);
        return $this->successResponse(RoomBookResource::make($roomBook));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomBook  $roomBook
     * @return \Illuminate\Http\Response
     */
    public function show(RoomBook $roomBook)
    {
        return $this->successResponse(RoomBookResource::make($roomBook));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomBookRequest  $request
     * @param  \App\Models\RoomBook  $roomBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomBookRequest $request, RoomBook $roomBook)
    {
        $validatedData = $request->validated();

        $roomBookingService = new RoomBookingService();
        $isDateValid = $roomBookingService->checkBookingDate($validatedData['check_in'], $validatedData['check_out'], $validatedData['room_id']);

        if (!$isDateValid) {
            return $this->errorResponse('Invalid check-in or check-out dates. The selected range conflicts with another booked room.', Response::HTTP_FORBIDDEN);
        }
        $roomBook->update($request->validated());
        return $this->successResponse(RoomBookResource::make($roomBook));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomBook  $roomBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomBook $roomBook)
    {
        $roomBook->delete();
        return $this->deletedResponse();
    }
}
