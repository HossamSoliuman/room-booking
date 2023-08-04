<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Http\Requests\StoreBookMarkRequest;
use App\Http\Requests\UpdateBookMarkRequest;
use App\Http\Resources\BookMarkResource;

class BookMarkController extends Controller
{
    public function store(StoreBookMarkRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $bookMark = BookMark::create($data);
        return $this->successResponse(BookMarkResource::make($bookMark));
    }
    
    public function destroy(BookMark $bookMark)
    {
        if (!$this->isOwner($bookMark->user_id))
            return $this->deny();
        $bookMark->delete();
        return $this->deletedResponse();
    }
}
