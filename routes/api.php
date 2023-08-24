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

//admin routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResources(
        [
            'cities' => CityController::class,

        ]
    );
    Route::apiResource('room-books', RoomBookController::class)->only(['index', 'show']);
});

//public routes
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
//
Route::prefix('room')->group(function () {
    Route::get('books', [RoomController::class, 'books']);
});
Route::apiResources(
    [
        'cities' => CityController::class,
        'rooms' => RoomController::class,
    ],
    [
        'only' => ['index', 'show']
    ]
);

//auth routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::apiResource('room-books', RoomBookController::class)->except(['index']);
    Route::apiResource('rooms',RoomController::class);
    Route::prefix('users')->group(function () {
        Route::get('rooms', [UserController::class, 'rooms']);
        Route::get('favorite-cities', [UserController::class, 'favoriteCities']);
        Route::get('book-marks', [UserController::class, 'bookMarks']);
        Route::get('room-books', [UserController::class, 'roomBooks']);
    });

    Route::apiResources(
        [
            'book-marks' => BookMarkController::class,
            'favorite-cities' => FavoriteCityController::class,
            'room-images' => RoomImageController::class,
        ],
        ['store', 'destroy']
    );
    Route::apiResources(
        [],
        [
            'only' => ['index', 'show']
        ]
    );
});
