<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookMarkController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FavoriteCityController;
use App\Http\Controllers\RoomBookController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomImageController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use App\Models\RoomImage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//public routes

//auth
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);



//auth routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::apiResource('room-books', RoomBookController::class)->except(['index']);
    Route::get('users/rooms', [UserController::class, 'rooms']);
    Route::get('users/favorite-cities', [UserController::class, 'favoriteCities']);
    Route::get('users/book-marks', [UserController::class, 'bookMarks']);
    Route::get('users/room-books', [UserController::class, 'roomBooks']);
    Route::apiResources(
        [
            'book-marks' => BookMarkController::class,
            'favorite-cities' => FavoriteCityController::class,
            'room-images' => RoomImageController::class,
        ],
        ['store', 'destroy']
    );
    Route::apiResources(
        [
            'cities' => CityController::class,
            'rooms' => RoomController::class,
        ],
        ['index', 'show']
    );
});

//admin routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResources(
        [
            'cities' => CityController::class,
        ]
    );
    Route::apiResource('room-books', RoomBookController::class)->only(['index', 'show']);
});
