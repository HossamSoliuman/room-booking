<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Http\Requests\StoreBookMarkRequest;
use App\Http\Requests\UpdateBookMarkRequest;
use App\Http\Resources\BookMarkResource;

class BookMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookMarks = BookMark::all();
        return $this->successResponse(BookMarkResource::collection($bookMarks));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookMarkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookMarkRequest $request)
    {
        $bookMark = BookMark::create($request->validated());
        return $this->successResponse(BookMarkResource::make($bookMark));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookMark  $bookMark
     * @return \Illuminate\Http\Response
     */
    public function show(BookMark $bookMark)
    {
        return $this->successResponse(BookMarkResource::make($bookMark));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookMarkRequest  $request
     * @param  \App\Models\BookMark  $bookMark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookMarkRequest $request, BookMark $bookMark)
    {
        $bookMark->update($request->validated());
        return $this->successResponse(BookMarkResource::make($bookMark));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookMark  $bookMark
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookMark $bookMark)
    {
        $bookMark->delete();
        return $this->deletedResponse();
    }
}
