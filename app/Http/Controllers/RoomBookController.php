<?php

namespace App\Http\Controllers;

use App\Models\RoomBook;
use App\Http\Requests\StoreRoomBookRequest;
use App\Http\Requests\UpdateRoomBookRequest;
use App\Http\Resources\RoomBookResource;

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
        $roomBook = RoomBook::create($request->validated());
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
