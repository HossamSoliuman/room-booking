<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCity;
use App\Http\Requests\StoreFavoriteCityRequest;
use App\Http\Requests\UpdateFavoriteCityRequest;
use App\Http\Resources\FavoriteCityResource;

class FavoriteCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoriteCitys = FavoriteCity::all();
        return $this->successResponse(FavoriteCityResource::collection($favoriteCitys));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFavoriteCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFavoriteCityRequest $request)
    {
        $favoriteCity = FavoriteCity::create($request->validated());
        return $this->successResponse(FavoriteCityResource::make($favoriteCity));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FavoriteCity  $favoriteCity
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteCity $favoriteCity)
    {
        return $this->successResponse(FavoriteCityResource::make($favoriteCity));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFavoriteCityRequest  $request
     * @param  \App\Models\FavoriteCity  $favoriteCity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFavoriteCityRequest $request, FavoriteCity $favoriteCity)
    {
        $favoriteCity->update($request->validated());
        return $this->successResponse(FavoriteCityResource::make($favoriteCity));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FavoriteCity  $favoriteCity
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteCity $favoriteCity)
    {
        $favoriteCity->delete();
        return $this->deletedResponse();
    }
}
