<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookMarkResource;
use App\Http\Resources\FavoriteCityResource;
use App\Http\Resources\RoomBookResource;
use App\Http\Resources\RoomResource;
use App\Http\Resources\UserResource;
use App\Models\BookMark;
use App\Models\FavoriteCity;
use App\Models\Room;
use App\Models\RoomBook;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return $this->successResponse(UserResource::collection($users));
    }
    public function rooms()
    {
        $rooms = Room::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate();
        return $this->successResponse(RoomResource::collection($rooms));
    }
    public function favoriteCities()
    {
        $favoriteCities = FavoriteCity::with('city')->where('user_id', auth()->id())->get();
        return $this->successResponse(FavoriteCityResource::collection($favoriteCities));
    }
    public function bookMarks()
    {
        $bookMarks = BookMark::where('user_id', auth()->id())->get();
        return $this->successResponse(BookMarkResource::collection($bookMarks->load('user', 'room')));
    }
    public function roomBooks()
    {
        $roomBooks = RoomBook::where('user_id', auth()->id())->get();
        return $this->successResponse(RoomBookResource::collection($roomBooks));
    }
    public function auth()
    {
        return $this->successResponse(UserResource::make(auth()->user()));
    }
}
