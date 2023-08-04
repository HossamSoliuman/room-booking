<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCity;
use App\Http\Requests\StoreFavoriteCityRequest;
use App\Http\Requests\UpdateFavoriteCityRequest;
use App\Http\Resources\FavoriteCityResource;

class FavoriteCityController extends Controller
{

    public function store(StoreFavoriteCityRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $favoriteCity = FavoriteCity::create($request->validated());
        return $this->successResponse(FavoriteCityResource::make($favoriteCity));
    }

    public function destroy(FavoriteCity $favoriteCity)
    {
        $favoriteCity->delete();
        return $this->deletedResponse();
    }
}
